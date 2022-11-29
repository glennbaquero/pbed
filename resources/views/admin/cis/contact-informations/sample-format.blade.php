<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Confidentiality Category</th>
                @foreach($definite_fields as $field)
                    <th>{{ $field->name }}</th>
                @endforeach
                @foreach($category->fields as $field)
                    <th>{{ $field->name }}</th>
                @endforeach
                <th>notes</th>
            </tr>
        </thead>
        <tbody>
            <tr style="visibility: hidden;">
                <td>Add comma (,) for each confidentiality category</td>
                @foreach($definite_fields as $field)
                <td >{{ $field->id }} - {{ $field->hidden }} - 1 </td>
                @endforeach

                @foreach($category->fields as $field)
                    <td >{{ $field->id }} - {{ $field->hidden }} - 0 </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</body>
</html>
                