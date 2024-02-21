<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .receipt {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 100%;
        }

        h1 {
            text-align: center;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            justify-content: end;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <h1>Struk Pembayaran</h1>
        <div class="info">
            <p>Kode Transaksi: {{ $data['no_transaksi'] }}</p>
            <p>Tanggal Transaksi: {{ $data['tgl_transaksi'] }}</p>
        </div>
        <table>
            <tr>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Jumlah Harga</th>
            </tr>
            @if ($detail)
                @foreach ($detail as $item)
                    <tr>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ number_format($item->harga_satuan,2,",",".") }}</td>
                        <td>{{ $item->jumlah_barang }}</td>
                        <td>{{ number_format($item->harga_total, 2, ",", ".") }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="total">Total Biaya : {{ number_format($data['total_bayar'], 2, ",", ".") }}</td>
                </tr>
            @endif
            
        </table>
    </div>
</body>

</html>
