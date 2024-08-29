<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        /* Tambahkan gaya CSS yang diperlukan di sini */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    <p>Periode: {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Id Transaction</th>
                <th>Transaction Date</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $transaction)
            <tr>
                <td>{{ $transaction->process_code }}</td>
                <td>{{ $transaction->transaction_date }}</td>
                <td>{{ $transaction->name }}</td>
                <td>{{ $transaction->phone }}</td>
                <td>{{ $transaction->address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
