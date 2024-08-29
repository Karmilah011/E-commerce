<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Selling Products</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Top Selling Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Sold</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ProductSell as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>Rp. {{ number_format($item->price, 2, ',', '.') }}</td>
                <td>{{ $item->sold }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
