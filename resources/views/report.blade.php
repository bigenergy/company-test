<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <style>
         body {
             font-family: DejaVu Sans;
         }
     </style>
    <title>Экспорт PDF</title>
</head>
<body>
<div class="row">
    <table>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Email</th>
            <th>Отдел</th>
        </tr>
        @foreach ($workers as $worker)
            <tr>
                <td>{{ $worker->name }}</td>
                <td>{{ $worker->family }}</td>
                <td>{{ $worker->patronymic }}</td>
                <td>{{ $worker->email }}</td>
                <td>{{ $worker->department->name }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>