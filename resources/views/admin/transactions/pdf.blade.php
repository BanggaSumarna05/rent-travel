<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* ─── BASE ───────────────────────────────────────────── */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #334155;
            padding: 30px;
        }

        /* ─── HEADER ─────────────────────────────────────────── */
        .header {
            border-bottom: 3px solid #0ea5e9;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header table { width: 100%; }

        .logo { width: 60px; }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
        }

        .subtitle {
            font-size: 11px;
            color: #64748b;
        }

        .print-date {
            text-align: right;
            font-size: 11px;
        }

        /* ─── KPI CARDS ──────────────────────────────────────── */
        .kpi-section { margin: 20px 0; }

        .kpi-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
        }

        .kpi-title {
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
        }

        .kpi-value {
            font-size: 20px;
            font-weight: bold;
            margin-top: 4px;
        }

        .money { color: #059669; }

        /* ─── MINI CHART ─────────────────────────────────────── */
        .chart { margin: 20px 0; }

        .chart-title {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .chart-label { font-size: 10px; }

        .chart-bar {
            background: #e2e8f0;
            height: 6px;
            border-radius: 4px;
            margin-bottom: 6px;
        }

        .chart-fill {
            background: #0ea5e9;
            height: 6px;
            border-radius: 4px;
        }

        /* ─── TABLE ──────────────────────────────────────────── */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            background: #0f172a;
            color: white;
            font-size: 10px;
            padding: 10px;
            text-transform: uppercase;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        .table tr:nth-child(even) { background: #f9fafb; }

        tfoot td {
            font-weight: bold;
            background: #f1f5f9;
            border-top: 2px solid #94a3b8;
            padding: 12px;
        }

        /* ─── BADGES ─────────────────────────────────────────── */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-pending   { background: #fef3c7; color: #92400e; }
        .badge-confirmed { background: #dbeafe; color: #1e40af; }
        .badge-completed { background: #d1fae5; color: #065f46; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }

        /* ─── HELPERS ────────────────────────────────────────── */
        .text-right  { text-align: right; }
        .text-center { text-align: center; }
        .bold        { font-weight: bold; }
        .muted       { font-size: 10px; color: #64748b; }

        /* ─── FOOTER ─────────────────────────────────────────── */
        .footer {
            margin-top: 40px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            font-size: 10px;
            color: #64748b;
        }
    </style>
</head>

<body>

@php
    $totalAmount      = $transactions->sum('total_price');
    $totalTransactions = $transactions->count();
    $avgOrder         = $totalTransactions > 0 ? $totalAmount / $totalTransactions : 0;

    $logoPath = public_path('logo.png');
    $logoExt  = pathinfo($logoPath, PATHINFO_EXTENSION);
    $logoB64  = 'data:image/' . $logoExt . ';base64,' . base64_encode(file_get_contents($logoPath));
@endphp


{{-- ── HEADER ───────────────────────────────────────────────── --}}
<div class="header">
    <table>
        <tr>
            <td style="width: 70px">
                <img src="{{ $logoB64 }}" class="logo">
            </td>
            <td>
                <div class="title">Transaction Report</div>
                <div class="subtitle">CJA Rent Car – Booking Management System</div>
            </td>
            <td class="print-date">
                Generated<br>
                <strong>{{ now()->format('d M Y H:i') }}</strong>
            </td>
        </tr>
    </table>
</div>


{{-- ── KPI CARDS ───────────────────────────────────────────── --}}
<div class="kpi-section">
    <table width="100%">
        <tr>
            <td width="33%">
                <div class="kpi-card">
                    <div class="kpi-title">Total Revenue</div>
                    <div class="kpi-value money">
                        Rp {{ number_format($totalAmount, 0, ',', '.') }}
                    </div>
                </div>
            </td>
            <td width="33%">
                <div class="kpi-card">
                    <div class="kpi-title">Total Orders</div>
                    <div class="kpi-value">{{ $totalTransactions }}</div>
                </div>
            </td>
            <td width="33%">
                <div class="kpi-card">
                    <div class="kpi-title">Average Order</div>
                    <div class="kpi-value">
                        Rp {{ number_format($avgOrder, 0, ',', '.') }}
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>


{{-- ── MINI REVENUE CHART ──────────────────────────────────── --}}
<div class="chart">
    <div class="chart-title">Revenue Distribution</div>

    @foreach ($transactions->take(5) as $t)
        <div class="chart-label">{{ $t->customer_name }}</div>
        <div class="chart-bar">
            <div class="chart-fill"
                 style="width: {{ $totalAmount > 0 ? ($t->total_price / $totalAmount) * 100 : 0 }}%">
            </div>
        </div>
    @endforeach
</div>


{{-- ── TRANSACTION TABLE ───────────────────────────────────── --}}
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Layanan</th>
            <th>Periode</th>
            <th class="text-right">Total</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($transactions as $trx)
            <tr>
                <td class="bold">#{{ $trx->id }}</td>

                <td>
                    <div class="bold">{{ $trx->customer_name }}</div>
                    <div class="muted">{{ $trx->customer_phone }}</div>
                    @if ($trx->customer_email)
                        <div class="muted">{{ $trx->customer_email }}</div>
                    @endif
                </td>

                <td>
                    <div class="bold">{{ $trx->serviceCategoryLabel() }}</div>
                    <div class="muted">{{ $trx->serviceDisplayName() }}</div>
                    @if ($trx->driverOptionLabel())
                        <div class="muted">{{ $trx->driverOptionLabel() }}</div>
                    @endif
                    @if ($trx->locationLabel())
                        <div class="muted">{{ $trx->locationLabel() }}</div>
                    @endif
                </td>

                <td>
                    {{ $trx->start_date->format('d M Y') }}
                    @if ($trx->end_date)
                        <div class="muted">s/d {{ $trx->end_date->format('d M Y') }}</div>
                    @endif
                </td>

                <td class="text-right bold">
                    Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                </td>

                <td class="text-center">
                    <span class="badge badge-{{ $trx->status }}">
                        {{ ucfirst($trx->status) }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="4" class="text-right">TOTAL KESELURUHAN</td>
            <td class="text-right">
                Rp {{ number_format($totalAmount, 0, ',', '.') }}
            </td>
            <td></td>
        </tr>
    </tfoot>
</table>


{{-- ── FOOTER ──────────────────────────────────────────────── --}}
<div class="footer">
    Dokumen ini dihasilkan secara otomatis oleh sistem <strong>CJA Rent Car</strong>.<br>
    Generated at {{ now()->format('d/m/Y H:i:s') }}
</div>

</body>
</html>
