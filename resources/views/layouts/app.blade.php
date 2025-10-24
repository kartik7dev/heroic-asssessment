<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEROIC Breach Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-light">
    <div class="container mt-4">
       {{ $slot }}
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
