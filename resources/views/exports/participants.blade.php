<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10px; /* Reduced font size for better fitting */
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word; /* Allow wrapping of long text */
            max-width: 150px; /* Set a max width for cells to ensure the table doesn't overflow */
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 12px; /* Slightly larger font for headers */
        }
        td {
            text-align: center;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
    <style>
    @page {
        size: A4 landscape; /* Sets the page to landscape */
        margin: 20mm;
    }
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        font-size: 10px;
    }
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
    <h1>Participants Export</h1>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Taskira Number</th>
                    <th>Organization</th>
                    <th>Position</th>
                    <th>Training Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participants as $participant)
                    <tr>
                        <td>{{ $participant->id }}</td>
                        <td>{{ $participant->full_name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone_number }}</td>
                        <td>{{ $participant->address }}</td>
                        <td>{{ $participant->taskira_number }}</td>
                        <td>{{ $participant->organization }}</td>
                        <td>{{ $participant->position }}</td>
                        <td>{{ $participant->training ? $participant->training->name : 'N/A' }}</td>
                        <td>{{ $participant->created_at }}</td>
                        <td>{{ $participant->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
