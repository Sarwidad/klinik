<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tagihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2d3e50;
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            font-size: 2.5em;
            color: #2d3e50;
        }

        .header p {
            font-size: 1.1em;
            color: #7f8c8d;
        }

        .content {
            margin-bottom: 30px;
        }

        .content p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .content strong {
            color: #2d3e50;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .details-table th,
        .details-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .details-table th {
            background-color: #2d3e50;
            color: white;
        }

        .details-table td {
            background-color: #f9f9f9;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            color: #e74c3c;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 1em;
            color: #7f8c8d;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>Tagihan Klinik</h2>
            <p>Alamat Klinik: Jalan Asia Afrika 12 | Telepon: (602) 519-0450</p>
        </div>

        <!-- Tagihan Info -->
        <div class="content">
            <h1>Tagihan #{{ $tagihan->id }}</h1>
            <p><strong>Pasien:</strong> {{ $tagihan->rekamMedis && $tagihan->rekamMedis->pasien ? $tagihan->rekamMedis->pasien->nama : 'Pasien tidak ditemukan' }}</p>
            <p><strong>Tanggal Tagihan:</strong> {{ $tagihan->tanggal_tagihan }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $tagihan->status_pembayaran }}</p>
        </div>

        <!-- Tagihan Details Table -->
        <table class="details-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- Tampilkan Tindakan --}}
                @if($tagihan->rekamMedis && $tagihan->rekamMedis->tindakans)
                    @foreach($tagihan->rekamMedis->tindakans as $tindakan)
                        <tr>
                            <td>{{ $tindakan->nama_tindakan }}</td>
                            <td>Rp. {{ number_format($tindakan->harga, 2) }}</td>
                            <td>Rp. {{ number_format($tindakan->harga * 1, 2) }}</td>
                        </tr>
                    @endforeach
                @endif

                {{-- Tampilkan Obat --}}
                @if($tagihan->rekamMedis && $tagihan->rekamMedis->obats)
                    @foreach($tagihan->rekamMedis->obats as $obat)
                        <tr>
                            <td>{{ $obat->nama_obat }}</td>
                            <td>Rp. {{ number_format($obat->harga, 2) }}</td>
                            <td>Rp. {{ number_format($obat->harga * ($obat->pivot->jumlah ?? 1), 2) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <!-- Total Amount -->
        <p class="total"><strong>Total Tagihan:</strong> Rp. {{ number_format($tagihan->total_tagihan, 2) }}</p>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima Kasih atas Kepercayaan Anda</strong></p>
            <p>E-Klinik | Jalan Asia Afrika 12 | Telepon: (602) 519-0450</p>
            <p><a href="mailto:e-klinik@email.com">klinik@email.com</a></p>
        </div>
    </div>
</body>

</html>
