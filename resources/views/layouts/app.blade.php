<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VeloSearch</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function standby($id) {
            document.getElementById('backup-' + $id).src = 'images/notfound.png'
        }
    </script>
</head>
<body>
    @yield('content')
</body>
</html>