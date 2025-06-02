<!DOCTYPE html>
<html>
<head>
    <title>Purchases Report</title>
    <style>
        /* Basic styling for PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>Purchases Report</h2>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Plant</th>
                <th>Price (Php)</th>
                <th>Quantity</th>
                <th>Total (Php)</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->customer->name ?? '-' }}</td>
                    <td>{{ $purchase->plant->name ?? '-' }}</td>
                    <td>{{ number_format($purchase->price, 2) }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ number_format($purchase->price * $purchase->quantity, 2) }}</td>
                    <td>{{ $purchase->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
