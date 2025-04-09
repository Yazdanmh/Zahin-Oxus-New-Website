<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificates Export</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            word-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Certificates Export</h1>
    <table>
        <thead>
            <tr>
                <th>Certificate Code</th>
                <th>Certificate Name</th>
                <th>Issue Date</th>
                <th>Issued For</th>
                <th>Training Name</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->certificate_code }}</td>
                    <td>{{ $certificate->certificate_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($certificate->issue_date)->format('Y-m-d') }}</td>
                    <td>{{ $certificate->for_who }}</td>
                    <td>{{ $certificate->training ? $certificate->training->name : 'N/A' }}</td>
                    <td>{{ $certificate->created_at->format('Y-m-d') }}</td>
                    <td>{{ $certificate->updated_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
