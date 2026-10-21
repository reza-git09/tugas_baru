<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembelian</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .invoice-info {
            margin-top: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>INVOICE PEMBELIAN</h1>
        <p>Toko Praktikum Laravel</p>
    </div>

    <div class="invoice-info">
        <p><strong>Nomor Invoice:</strong> INV-2026-001</p>
        <p><strong>Tanggal:</strong> {{ date('d-m-Y') }}</p>
        <p><strong>Nama Pelanggan:</strong> Reza Dwi Pratama</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Sepatu</td>
                <td>1</td>
                <td>Rp250.000</td>
                <td>Rp250.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tas</td>
                <td>2</td>
                <td>Rp150.000</td>
                <td>Rp300.000</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        Total Pembayaran: Rp550.000
    </div>

    <div class="footer">
        <p>Terima kasih telah melakukan pembelian.</p>
    </div>

</body>
</html>