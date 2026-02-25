<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        .table td {
            border: 1px solid #ddd;
            padding: 6px;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success { background-color: #28a745; color: white; }
        .badge-warning { background-color: #ffc107; color: black; }
        .badge-danger { background-color: #dc3545; color: white; }
        .badge-info { background-color: #17a2b8; color: white; }
        .badge-primary { background-color: #007bff; color: white; }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ACTIVITY LOG</h1>
        <p>Dicetak pada: {{ $date }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>User</th>
                <th>Model Type</th>
                <th>Model ID</th>
                <th>Action</th>
                <th>Description</th>
                <th>IP Address</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($activityLogs as $log)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ formatTanggalIndonesia($log->created_at) }}</td>
                <td>{{ $log->created_at->format('H:i:s') }}</td>
                <td>
                    @if($log->user)
                        {{ $log->user->name }}
                    @else
                        System
                    @endif
                </td>
                <td>{{ $log->model_type }}</td>
                <td>{{ $log->model_id }}</td>
                <td>
                    <span class="badge 
                        @if($log->action == 'created') badge-success
                        @elseif($log->action == 'updated') badge-warning
                        @elseif($log->action == 'deleted') badge-danger
                        @else badge-secondary @endif">
                        {{ ucfirst($log->action) }}
                    </span>
                </td>
                <td>{{ Str::limit($log->description, 100) }}</td>
                <td>{{ $log->ip_address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data: {{ $activityLogs->count() }} activity log</p>
        <p>Laporan ini dicetak secara otomatis oleh sistem</p>
    </div>
</body>
</html>
