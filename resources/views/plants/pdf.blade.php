<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Plants PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h2>Plants Report</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Water Requirement (ml)</th>
                <th>Temperature (°C)</th>
                <th>Planted Date</th>
                <th>Price (Php)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plants as $plant)
                <tr>
                    <td>{{ $plant->name }}</td>
                    <td>{{ $plant->water_requirement }}</td>
                    <td>{{ $plant->temperature }}</td>
                    <td>{{ \Carbon\Carbon::parse($plant->planted_date)->format('Y-m-d') }}</td>
                    <td>{{ number_format($plant->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
