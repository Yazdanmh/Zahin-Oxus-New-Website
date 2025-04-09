<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainings Export</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Trainings Export</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Service</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trainings as $training)
                <tr>
                    <td>{{ $training->id }}</td>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->service ? $training->service->title : 'N/A' }}</td>
                    <td>{{ $training->start_date }}</td>
                    <td>{{ $training->end_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
