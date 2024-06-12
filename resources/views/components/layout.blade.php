<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <title>PowerMaromba</title>
    <style>
        .fade-in {
            opacity: 0;
            transition: opacity 0.7s ease-in;
        }

        .fade-in.show {
            opacity: 1;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            align-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div
        class="bg-gray-100 flex justify-center items-center {{ Request::route() && Request::route()->getName() !== 'onerepmax.process' ? 'h-screen' : '' }}">
        <div class="lg:p-36 md:p-52 sm:20 p-8 fade-in">
            <x-logo />
            {{ $slot }}
        </div>
    </div>

</body>
<script src="{{ asset('js/requests.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.fade-in').addClass('show');
    });
</script>

</html>
