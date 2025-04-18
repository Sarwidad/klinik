<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Rekam Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 40px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h2 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
        }

        .header p {
            margin: 5px 0;
            color: #7f8c8d;
        }

        .info-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 10px 8px;
        }

        .info-table .label {
            font-weight: bold;
            width: 180px;
            background-color: #f9f9f9;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 6px;
            color: #2c3e50;
        }

        .box {
            background-color: #f9f9f9;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        .badge {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 6px 10px;
            border-radius: 4px;
            margin: 3px 3px 0 0;
            font-size: 13px;
        }

        .footer {
            text-align: right;
            margin-top: 50px;
            color: #7f8c8d;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>Rekam Medis Pasien</h2>
            <p>Klinik Sarwidad - Sistem Informasi Rekam Medis</p>
        </div>

        <!-- Informasi Pasien -->
        <table class="info-table">
            <tr>
                <td class="label">Nama Pasien</td>
                <td>{{ $rekam->pasien->nama }}</td>
            </tr>
            <tr>
                <td class="label">Nama Pegawai</td>
                <td>{{ $rekam->pegawai->nama }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Periksa</td>
                <td>{{ \Carbon\Carbon::parse($rekam->tanggal_periksa)->format('d-m-Y') }}</td>
            </tr>
        </table>

        <!-- Keluhan -->
        <div class="section">
            <div class="section-title">Keluhan</div>
            <div class="box">{{ $rekam->keluhan }}</div>
        </div>

        <!-- Diagnosa -->
        <div class="section">
            <div class="section-title">Diagnosa</div>
            <div class="box">{{ $rekam->diagnosa }}</div>
        </div>

        <!-- Catatan -->
        <div class="section">
            <div class="section-title">Catatan</div>
            <div class="box">{{ $rekam->catatan ?? '-' }}</div>
        </div>

        <!-- Tindakan -->
        <div class="section">
            <div class="section-title">Tindakan</div>
            <div class="box">
                @foreach ($rekam->tindakans as $tindakan)
                    <span class="badge">{{ $tindakan->nama_tindakan }}</span>
                @endforeach
            </div>
        </div>

        <!-- Obat -->
        <div class="section">
            <div class="section-title">Obat</div>
            <div class="box">
                @foreach ($rekam->obats as $obat)
                    <span class="badge">{{ $obat->nama_obat }}</span>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
