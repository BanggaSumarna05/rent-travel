<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        @page {
            margin: 28px 30px 34px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            line-height: 1.45;
            color: #334155;
            background: #ffffff;
        }

        .report-shell {
            width: 100%;
        }

        .header {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #f8fafc;
            padding: 18px 20px;
            margin-bottom: 18px;
        }

        .header-table,
        .summary-table,
        .overview-table,
        .transactions-table,
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .brand-cell {
            width: 58%;
        }

        .meta-cell {
            width: 42%;
            text-align: right;
        }

        .logo-wrap {
            width: 54px;
            vertical-align: top;
        }

        .logo-box {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            text-align: center;
            vertical-align: middle;
        }

        .logo-box img {
            width: 38px;
            height: 38px;
            object-fit: contain;
            margin-top: 3px;
        }

        .eyebrow {
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #b45309;
            margin-bottom: 4px;
        }

        .title {
            font-size: 21px;
            font-weight: 700;
            letter-spacing: -0.4px;
            color: #0f172a;
            margin: 0 0 3px;
        }

        .subtitle {
            font-size: 10px;
            color: #64748b;
            margin: 0;
        }

        .meta-label {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 3px;
        }

        .meta-value {
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .summary-table {
            table-layout: fixed;
            margin-bottom: 18px;
        }

        .summary-table td {
            width: 25%;
            padding-right: 10px;
            vertical-align: top;
        }

        .summary-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #ffffff;
            padding: 14px 15px;
            min-height: 76px;
        }

        .summary-card .label {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #94a3b8;
            margin-bottom: 6px;
        }

        .summary-card .value {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .summary-card .hint {
            font-size: 9px;
            color: #64748b;
        }

        .value.money {
            color: #0f766e;
        }

        .overview-table td {
            width: 50%;
            vertical-align: top;
            padding-right: 10px;
        }

        .panel {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            padding: 14px 16px;
            min-height: 120px;
        }

        .panel-title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            color: #94a3b8;
            margin-bottom: 10px;
        }

        .status-row,
        .service-row {
            margin-bottom: 9px;
        }

        .status-row:last-child,
        .service-row:last-child {
            margin-bottom: 0;
        }

        .row-top {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .row-top td:last-child {
            text-align: right;
            font-weight: 700;
            color: #0f172a;
        }

        .row-label {
            font-size: 10px;
            font-weight: 700;
            color: #334155;
        }

        .bar-track {
            height: 6px;
            width: 100%;
            border-radius: 999px;
            background: #e2e8f0;
            overflow: hidden;
        }

        .bar-fill {
            height: 6px;
            border-radius: 999px;
        }

        .bar-pending { background: #f59e0b; }
        .bar-confirmed { background: #3b82f6; }
        .bar-completed { background: #10b981; }
        .bar-cancelled { background: #ef4444; }

        .service-meta {
            font-size: 9px;
            color: #64748b;
        }

        .transactions-table {
            margin-top: 18px;
        }

        .transactions-table thead th {
            background: #0f172a;
            color: #ffffff;
            padding: 11px 10px;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-right: 1px solid #1e293b;
        }

        .transactions-table thead th:last-child {
            border-right: none;
        }

        .transactions-table tbody td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .transactions-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .transactions-table tfoot td {
            padding: 11px 10px;
            border-top: 2px solid #cbd5e1;
            background: #f8fafc;
            font-weight: 700;
            color: #0f172a;
        }

        .id-text {
            font-weight: 700;
            color: #0f172a;
        }

        .primary-text {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .secondary-text {
            font-size: 9px;
            color: #64748b;
        }

        .price-text {
            font-weight: 700;
            color: #0f172a;
            text-align: right;
            white-space: nowrap;
        }

        .align-right {
            text-align: right;
        }

        .align-center {
            text-align: center;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 18px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            font-size: 9px;
            color: #64748b;
        }

        .footer-right {
            text-align: right;
        }
    </style>
</head>
<body>
@php
    $siteName = \App\Models\Setting::get('site_name', 'CJA RENT CAR');
    $generatedAt = now();
    $totalTransactions = $transactions->count();
    $totalAmount = (float) $transactions->sum('total_price') + (float) $transactions->sum('penalty_amount') - (float) $transactions->sum('discount_amount');
    $totalPenalty = (float) $transactions->sum('penalty_amount');
    $totalDiscount = (float) $transactions->sum('discount_amount');
    $averageOrder = $totalTransactions > 0 ? $totalAmount / $totalTransactions : 0;
    $confirmedRevenue = (float) $transactions->whereIn('status', ['confirmed', 'completed'])->sum(function($t) { 
        return $t->total_price + $t->penalty_amount - $t->discount_amount; 
    });

    $filterMonth = request('month');
    $filterYear = request('year');
    $filterStatus = request('status');
    $filterLabel = "Semua Periode";

    if($filterMonth && $filterYear) {
        $filterLabel = \Carbon\Carbon::create()->month($filterMonth)->year($filterYear)->isoFormat('MMMM Y');
    } elseif ($filterYear) {
        $filterLabel = "Tahun " . $filterYear;
    } elseif ($filterMonth) {
        $filterLabel = "Bulan " . \Carbon\Carbon::create()->month($filterMonth)->isoFormat('MMMM');
    }
    $periodStart = $transactions->min('start_date');
    $periodEnd = $transactions->max('end_date') ?: $transactions->max('start_date');
    $statusSummary = [
        'pending' => ['label' => 'Menunggu', 'count' => $transactions->where('status', 'pending')->count()],
        'confirmed' => ['label' => 'Dikonfirmasi', 'count' => $transactions->where('status', 'confirmed')->count()],
        'completed' => ['label' => 'Selesai', 'count' => $transactions->where('status', 'completed')->count()],
        'cancelled' => ['label' => 'Dibatalkan', 'count' => $transactions->where('status', 'cancelled')->count()],
    ];
    $topServices = $transactions
        ->groupBy(fn ($transaction) => $transaction->serviceDisplayName())
        ->map(function ($items, $service) {
            return [
                'service' => $service,
                'category' => $items->first()->serviceCategoryLabel(),
                'count' => $items->count(),
            ];
        })
        ->sortByDesc('count')
        ->take(4)
        ->values();

    $logoBase64 = null;
    foreach (['logo.png', 'logo.jpg', 'logo.JPG', 'logo2.png', 'favicon.ico'] as $logoCandidate) {
        $logoPath = public_path($logoCandidate);

        if (! is_file($logoPath)) {
            continue;
        }

        $extension = strtolower(pathinfo($logoPath, PATHINFO_EXTENSION));
        $mime = match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'ico' => 'image/x-icon',
            default => null,
        };

        if ($mime === null) {
            continue;
        }

        $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($logoPath));
        break;
    }

    $safeTransactionTotal = max($totalTransactions, 1);
@endphp

<div class="report-shell">
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="brand-cell">
                    <table>
                        <tr>
                            @if ($logoBase64)
                                <td class="logo-wrap">
                                    <div class="logo-box">
                                        <img src="{{ $logoBase64 }}" alt="{{ $siteName }}">
                                    </div>
                                </td>
                            @endif
                            <td>
                                <div class="eyebrow">Laporan Booking</div>
                                <h1 class="title">Laporan Transaksi {{ $siteName }}</h1>
                                <p class="subtitle">Periode: <strong style="color: #0f172a;">{{ $filterLabel }}</strong> | {{ $filterStatus ? 'Status: ' . ucfirst($filterStatus) : 'Semua Status' }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="meta-cell">
                    <div class="meta-label">Tanggal Cetak</div>
                    <div class="meta-value">{{ $generatedAt->format('d M Y, H:i') }}</div>
                    <div class="meta-label">Periode Booking</div>
                    <div class="meta-value">
                        @if ($periodStart)
                            {{ $periodStart->format('d M Y') }}
                            @if ($periodEnd)
                                - {{ $periodEnd->format('d M Y') }}
                            @endif
                        @else
                            Belum ada data
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table class="summary-table">
        <tr>
            <td>
                <div class="summary-card">
                    <div class="label">Total Transaksi</div>
                    <div class="value">{{ $totalTransactions }}</div>
                    <div class="hint">Semua booking yang tercatat</div>
                </div>
            </td>
            <td>
                <div class="summary-card">
                    <div class="label">Total Pendapatan</div>
                    <div class="value money">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                    <div class="hint">Akumulasi seluruh transaksi</div>
                </div>
            </td>
            <td>
                <div class="summary-card">
                    <div class="label">Rata-rata Booking</div>
                    <div class="value">Rp {{ number_format($averageOrder, 0, ',', '.') }}</div>
                    <div class="hint">Nilai rata-rata per transaksi</div>
                </div>
            </td>
            <td>
                <div class="summary-card">
                    <div class="label">Pendapatan Valid</div>
                    <div class="value money">Rp {{ number_format($confirmedRevenue, 0, ',', '.') }}</div>
                    <div class="hint">Status confirmed + completed</div>
                </div>
            </td>
        </tr>
    </table>

    <table class="overview-table">
        <tr>
            <td>
                <div class="panel">
                    <div class="panel-title">Distribusi Status</div>
                    @foreach ($statusSummary as $status => $item)
                        <div class="status-row">
                            <table class="row-top">
                                <tr>
                                    <td class="row-label">{{ $item['label'] }}</td>
                                    <td>{{ $item['count'] }}</td>
                                </tr>
                            </table>
                            <div class="bar-track">
                                <div class="bar-fill bar-{{ $status }}"
                                    style="width: {{ round(($item['count'] / $safeTransactionTotal) * 100, 2) }}%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </td>
            <td>
                <div class="panel">
                    <div class="panel-title">Layanan Paling Sering Dibooking</div>
                    @forelse ($topServices as $service)
                        <div class="service-row">
                            <table class="row-top">
                                <tr>
                                    <td class="row-label">{{ $service['service'] }}</td>
                                    <td>{{ $service['count'] }}x</td>
                                </tr>
                            </table>
                            <div class="service-meta">{{ $service['category'] }}</div>
                        </div>
                    @empty
                        <div class="secondary-text">Belum ada layanan yang bisa direkap.</div>
                    @endforelse
                </div>
            </td>
        </tr>
    </table>

    <table class="transactions-table">
        <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th style="width: 23%;">Pelanggan</th>
                <th style="width: 25%;">Layanan</th>
                <th style="width: 18%;">Jadwal</th>
                <th style="width: 14%;" class="align-right">Total</th>
                <th style="width: 12%;" class="align-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>
                        <div class="id-text">INV-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </td>
                    <td>
                        <div class="primary-text">{{ $transaction->customer_name }}</div>
                        <div class="secondary-text">{{ $transaction->customer_phone }}</div>
                        @if ($transaction->customer_email)
                            <div class="secondary-text">{{ $transaction->customer_email }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="primary-text">{{ $transaction->serviceDisplayName() }}</div>
                        <div class="secondary-text">{{ $transaction->serviceCategoryLabel() }}</div>
                        @if ($transaction->driverOptionLabel())
                            <div class="secondary-text">{{ $transaction->driverOptionLabel() }}</div>
                        @endif
                        @if ($transaction->locationLabel())
                            <div class="secondary-text">{{ $transaction->locationLabel() }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="primary-text">{{ $transaction->start_date->format('d M Y') }}</div>
                        <div class="secondary-text">
                            @if ($transaction->end_date)
                                s/d {{ $transaction->end_date->format('d M Y') }}
                            @else
                                1 hari / menyesuaikan
                            @endif
                        </div>
                    </td>
                     <td class="price-text">
                        Rp {{ number_format($transaction->total_price + $transaction->penalty_amount - $transaction->discount_amount, 0, ',', '.') }}
                        @if($transaction->penalty_amount > 0)
                            <div style="font-size: 7px; color: #ef4444; margin-top: 2px;">(Inc. Denda: Rp {{ number_format($transaction->penalty_amount, 0, ',', '.') }})</div>
                        @endif
                        @if($transaction->discount_amount > 0)
                            <div style="font-size: 7px; color: #10b981; margin-top: 1px;">(Disc: -Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }})</div>
                        @endif
                    </td>
                    <td class="align-center">
                        <span class="status-badge status-{{ $transaction->status }}">
                            {{ $statusSummary[$transaction->status]['label'] ?? ucfirst($transaction->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="align-center" style="padding: 22px 10px; color: #64748b;">
                        Belum ada transaksi yang bisa diekspor.
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="align-right">Total Keseluruhan</td>
                <td class="align-right">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <table class="footer-table footer">
        <tr>
            <td>Dokumen ini dibuat otomatis oleh sistem admin {{ $siteName }}.</td>
            <td class="footer-right">Dicetak pada {{ $generatedAt->format('d/m/Y H:i:s') }}</td>
        </tr>
    </table>
</div>
</body>
</html>
