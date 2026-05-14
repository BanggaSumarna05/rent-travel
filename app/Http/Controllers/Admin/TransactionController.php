<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\TourPackage;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class TransactionController extends Controller
{
    private const BOOKABLE_MODELS = [
        'Car' => Car::class,
        'Motorcycle' => Motorcycle::class,
        'TourPackage' => TourPackage::class,
    ];

    /**
     * Export transactions to Excel (Super Rapih).
     */
    public function exportExcel(Request $request)
    {
        $query = Transaction::with('bookable')->latest();
        $query = $this->applyFilters($query, $request);
        $transactions = $query->get();

        $filename = 'laporan-transaksi-' . now()->format('Y-m-d-Hi') . '.xlsx';

        $totalAmount = $transactions->whereIn('status', ['confirmed', 'completed'])->sum(fn($trx) => $trx->total_price + $trx->penalty_amount - $trx->discount_amount);
        $totalTransactions = $transactions->count();

        // Status mapping to Indonesian
        $statusLabels = [
            'pending' => 'Menunggu',
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        // Service type mapping to Indonesian
        $typeLabels = [
            'Car' => 'Mobil',
            'Motorcycle' => 'Motor',
            'TourPackage' => 'Paket Tour',
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('CJA RENT CAR')
            ->setTitle('Laporan Transaksi')
            ->setSubject('Laporan Transaksi CJA RENT CAR');

        // ===== HEADER SECTION =====
        $sheet->setCellValue('A1', 'LAPORAN TRANSAKSI CJA RENT CAR');
        $sheet->setCellValue('A2', 'Tanggal Cetak: ' . now()->format('d F Y, H:i'));
        $sheet->setCellValue('A3', 'Total Transaksi: ' . $totalTransactions . ' Transaksi');
        $sheet->setCellValue('A4', 'Total Pendapatan: Rp ' . number_format($totalAmount, 0, ',', '.'));

        // Merge and style title
        $sheet->mergeCells('A1:N1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Style statistics
        $sheet->getStyle('A2:A4')->getFont()->setSize(11);
        $sheet->getRowDimension(1)->setRowHeight(25);
        $sheet->getRowDimension(2)->setRowHeight(20);
        $sheet->getRowDimension(3)->setRowHeight(20);
        $sheet->getRowDimension(4)->setRowHeight(20);

        // ===== COLUMN HEADERS =====
        $headers = [
            'No',
            'ID Transaksi',
            'Nama Pelanggan',
            'No. Telepon',
            'Email',
            'Kategori Layanan',
            'Nama Layanan',
            'Opsi Driver',
            'Lokasi',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Total Harga (Rp)',
            'Status Pembayaran',
            'Catatan Tambahan',
            'Denda (Rp)',
            'Keterangan Denda',
            'Potongan (Rp)',
            'Keterangan Potongan',
            'Total Akhir (Rp)',
        ];

        $headerRow = 6;
        $startCol = 'A';
        foreach ($headers as $index => $header) {
            $cell = chr(65 + $index) . $headerRow;
            $sheet->setCellValue($cell, $header);
        }

        // Style headers - colored background
        $headerRange = 'A' . $headerRow . ':S' . $headerRow;
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('4F46E5'); // Indigo
        $sheet->getStyle($headerRange)->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getRowDimension($headerRow)->setRowHeight(25);

        // ===== DATA ROWS =====
        $dataRow = $headerRow + 1;
        $no = 1;
        foreach ($transactions as $transaction) {
            $originalType = str_replace('App\\Models\\', '', (string) $transaction->bookable_type);
            $type = $transaction->serviceCategoryLabel() ?: ($typeLabels[$originalType] ?? $originalType);
            $status = $statusLabels[$transaction->status] ?? strtoupper($transaction->status);

            $data = [
                $no,
                'INV-' . str_pad($transaction->id, 5, '0', STR_PAD_LEFT),
                $transaction->customer_name,
                "'" . $transaction->customer_phone,
                $transaction->customer_email,
                $type,
                $transaction->serviceDisplayName(),
                $transaction->driverOptionLabel() ?? '-',
                $transaction->locationLabel() ?? '-',
                $transaction->start_date->format('d/m/Y'),
                $transaction->end_date ? $transaction->end_date->format('d/m/Y') : '-',
                $transaction->total_price,
                $status,
                $transaction->customerNotes() ?? '-',
                $transaction->penalty_amount ?? 0,
                $transaction->penalty_details ?? '-',
                $transaction->discount_amount ?? 0,
                $transaction->discount_details ?? '-',
                $transaction->total_price + $transaction->penalty_amount - $transaction->discount_amount,
            ];

            foreach ($data as $colIndex => $value) {
                $cell = chr(65 + $colIndex) . $dataRow;
                $sheet->setCellValue($cell, $value);

                // Format currency columns (L, O, Q, S)
                if ($colIndex === 11 || $colIndex === 14 || $colIndex === 16 || $colIndex === 18) {
                    $sheet->getStyle($cell)->getNumberFormat()->setFormatCode('Rp #,##0');
                }

                // Center align ID and Status columns
                if ($colIndex === 0 || $colIndex === 1 || $colIndex === 12) {
                    $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }
            }

            $dataRow++;
            $no++;
        }

        // ===== BORDERS FOR DATA =====
        $dataRange = 'A' . $headerRow . ':S' . ($dataRow - 1);
        $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle($dataRange)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);

        // ===== TOTAL ROW =====
        $totalRow = $dataRow + 1;
        $sheet->mergeCells('A' . $totalRow . ':R' . $totalRow);
        $sheet->setCellValue('A' . $totalRow, 'TOTAL KESELURUHAN (INC. PENALTY & DISCOUNT):');
        $sheet->setCellValue('S' . $totalRow, $totalAmount);

        $totalRange = 'A' . $totalRow . ':S' . $totalRow;
        $sheet->getStyle($totalRange)->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A' . $totalRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('S' . $totalRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle($totalRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FEF3C7'); // Amber
        $sheet->getStyle($totalRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('S' . $totalRow)->getNumberFormat()->setFormatCode('Rp #,##0');

        // ===== PRINT DATE =====
        $printRow = $totalRow + 2;
        $sheet->setCellValue('A' . $printRow, 'Dicetak pada: ' . now()->format('d F Y, H:i:s'));
        $sheet->getStyle('A' . $printRow)->getFont()->setItalic(true)->setSize(9);
        $sheet->getStyle('A' . $printRow)->getFont()->getColor()->setRGB('6B7280');

        // ===== AUTO COLUMN WIDTH =====
        $columnWidths = [5, 15, 25, 15, 30, 18, 28, 18, 22, 15, 15, 18, 18, 25, 18, 30, 18, 30, 20];
        foreach ($columnWidths as $index => $width) {
            $col = chr(65 + $index);
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // ===== SET PRINT AREA =====
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);

        // Create writer
        $writer = new Xlsx($spreadsheet);

        // Return response
        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Export transactions to CSV.
     */
    // public function exportCsv()
    // {
    //     $transactions = Transaction::with('bookable')->latest()->get();
    //     $filename = 'laporan-transaksi-' . now()->format('Y-m-d-Hi') . '.csv';

    //     return response()->streamDownload(function () use ($transactions) {
    //         $handle = fopen('php://output', 'w');

    //         fputcsv($handle, [
    //             'ID Transaksi',
    //             'Nama Pelanggan',
    //             'No. Telepon',
    //             'Email',
    //             'Kategori Layanan',
    //             'Nama Layanan',
    //             'Opsi Driver',
    //             'Lokasi',
    //             'Tanggal Mulai',
    //             'Tanggal Selesai',
    //             'Total Harga',
    //             'Status',
    //             'Catatan',
    //         ]);

    //         foreach ($transactions as $transaction) {
    //             fputcsv($handle, [
    //                 'INV-' . str_pad($transaction->id, 5, '0', STR_PAD_LEFT),
    //                 $transaction->customer_name,
    //                 $transaction->customer_phone,
    //                 $transaction->customer_email,
    //                 $transaction->serviceCategoryLabel(),
    //                 $transaction->serviceDisplayName(),
    //                 $transaction->driverOptionLabel(),
    //                 $transaction->locationLabel(),
    //                 $transaction->start_date?->format('d/m/Y'),
    //                 $transaction->end_date?->format('d/m/Y'),
    //                 number_format((float) $transaction->total_price, 0, ',', '.'),
    //                 $transaction->status,
    //                 $transaction->customerNotes(),
    //             ]);
    //         }

    //         fclose($handle);
    //     }, $filename, [
    //         'Content-Type' => 'text/csv; charset=UTF-8',
    //     ]);
    // }


    /**
     * Export transactions to PDF.
     */
    public function exportPdf(Request $request)
    {
        $query = Transaction::with('bookable')->latest();
        $query = $this->applyFilters($query, $request);
        $transactions = $query->get();

        $pdf = Pdf::loadView('admin.transactions.pdf_new', compact('transactions'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-transaksi-' . now()->format('Y-m-d-His') . '.pdf');
    }

    private function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('service_name', 'like', "%{$search}%")
                  ->orWhere('service_category', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::with('bookable')->latest();
        $query = $this->applyFilters($query, $request);

        $transactions = $query->paginate(10)->withQueryString();
        
        // Stats based on filtered query (cloned to avoid manipulating main pagination query)
        $statsQuery = $this->applyFilters(Transaction::query(), $request);
        $totalTransactions = $statsQuery->count();
        $pendingTransactions = (clone $statsQuery)->where('status', 'pending')->count();
        $confirmedTransactions = (clone $statsQuery)->where('status', 'confirmed')->count();
        $totalRevenue = (clone $statsQuery)->whereIn('status', ['confirmed', 'completed'])->sum(\DB::raw('total_price + penalty_amount - discount_amount'));

        // Available years for filter
        $availableYears = Transaction::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.transactions.index', compact(
            'transactions', 
            'totalTransactions', 
            'pendingTransactions', 
            'confirmedTransactions',
            'totalRevenue',
            'availableYears'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        $motorcycles = Motorcycle::all();
        $tourPackages = TourPackage::all();

        return view('admin.transactions.create', compact('cars', 'motorcycles', 'tourPackages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'bookable_type' => ['required', 'string', Rule::in(array_keys(self::BOOKABLE_MODELS))],
            'bookable_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:100',
            'doc_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'doc_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'doc_npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'doc_ktp_penjamin' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $modelClass = self::BOOKABLE_MODELS[$validated['bookable_type']];
        $bookable = $modelClass::query()->findOrFail($validated['bookable_id']);

        // Calculate total price
        $totalPrice = 0;
        if ($validated['bookable_type'] === 'TourPackage') {
            $totalPrice = $bookable->price;
        }
        else {
            $start = \Carbon\Carbon::parse($validated['start_date']);
            $end = $validated['end_date'] ? \Carbon\Carbon::parse($validated['end_date']) : $start;
            $days = $start->diffInDays($end) ?: 1;
            $totalPrice = $bookable->price_per_day * $days;
        }

        $validated['bookable_type'] = $modelClass;
        $validated['total_price'] = $totalPrice;
        $validated['service_category'] = match ($request->input('bookable_type')) {
            'Car' => 'Rental Mobil',
            'Motorcycle' => 'Sewa Motor',
            'TourPackage' => 'Paket Wisata',
            default => 'Layanan Umum',
        };
        $serviceName = $bookable->name;
        if (isset($bookable->brand) && $bookable->brand) {
            $serviceName = $bookable->brand . ' ' . $bookable->name;
        }
        $validated['service_name'] = $serviceName;

        // Proses unggah dokumen (jika ada)
        $docs = ['doc_ktp', 'doc_kk', 'doc_npwp', 'doc_ktp_penjamin'];
        foreach ($docs as $doc) {
            if ($request->hasFile($doc)) {
                $file = $request->file($doc);
                $path = $file->storeAs(
                    'documents',
                    $doc . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
                $validated[$doc] = $path;
            }
        }

        Transaction::create($validated);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dibuat secara manual.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
            'penalty_amount' => 'nullable|numeric|min:0',
            'penalty_details' => 'nullable|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'discount_details' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Print invoice map.
     */
    public function printInvoice(Transaction $transaction)
    {
        $transaction->load('bookable');
        return view('admin.transactions.invoice', compact('transaction'));
    }
}
