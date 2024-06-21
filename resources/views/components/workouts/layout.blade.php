<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/workouts/page.css') }}">
    <title>Programas de Treinamento</title>
</head>

<body class="background text-white min-h-screen">
    <x-workouts.navbar />
    <div class="content w-full mt-24 md:mt-48 px-8 sm:px-32">
        {{ $slot }}
    </div>
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script src="{{ asset('js/workouts/filter.js') }}"></script>
    <script src="{{ asset('js/workouts/request.js') }}"></script>
</body>

</html>
