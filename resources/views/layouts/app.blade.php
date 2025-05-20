<!-- resources/views/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <title>User Registration</title> -->
    @yield('title')
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>
<body>

   @yield('content')
    @yield('script')
    <script src="{{asset('js/app.js')}}" type="module"></script>
</body>
</html>
