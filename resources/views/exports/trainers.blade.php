<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainers Export</title>
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
                <th>Position</th>
                <th>Service</th>
                <th>created_at</th>

                <th>updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trainers as $trainer)
                <tr>
                    <td>{{ $trainer->id }}</td>
                    <td>{{ $trainer->name }}</td>
                    <td>{{ $trainer->position }}</td>
                    <td>{{ $trainer->service ? $trainer->service->title : 'N/A' }}</td>
                    <td>{{ $trainer->created_at }}</td>
                    <td>{{ $trainer->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
