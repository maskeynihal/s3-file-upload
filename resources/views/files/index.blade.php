<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Files</title>
</head>

<body>
    <ul>
        @foreach ($files as $file)
            <li>
                <a href="{{ route('files.download', ['file' => $file]) }}">{{ $file }}</a>
            </li>
        @endforeach
    </ul>
</body>

</html>
