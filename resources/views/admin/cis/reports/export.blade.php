<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                @foreach($items as $item)
                    @foreach ($item['export_columns'] as $header)
                        <th>{{ $header['name'] }}</th>
                    @endforeach
                @endforeach
            </tr>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    @foreach($item['export_rows'] as $key => $row)
                        <td>{{ $row }}</td>
                    @endforeach
                </tr>
            @endforeach
        </thead>
    </table>
</body>
</html>
                