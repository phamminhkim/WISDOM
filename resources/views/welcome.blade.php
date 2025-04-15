<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel & Vue.js</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}"></script>
</head>
<body>
    <div id="app">
        <!-- <example-component></example-component> Đây là nơi bạn gọi component -->
        <vue-barcode> </vue-barcode>
    </div>

    <script src="{{ mix('js/app.js') }}"></script> <!-- Đảm bảo đường dẫn tới app.js -->
</body>
</html>
