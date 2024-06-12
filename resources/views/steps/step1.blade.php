<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <title>Marombapp</title>
    <style>
        .fade-in {
            opacity: 0;
            transition: opacity 0.7s ease-in;
        }

        .fade-in.show {
            opacity: 1;
        }
    </style>
</head>

<body>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="bg-gray-100 flex justify-center items-center h-screen">
        <div class="lg:p-36 md:p-52 sm:20 p-8 fade-in">
            <x-logo />
            <h1 class="text-2xl font-medium flex justify-center mb-12">Calcule suas porcentagens de 1RM!</h1>
            <form action="{{route('step2')}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block text-gray-600">Qual o seu nome?</label>
                    <input type="text" id="name" name="name"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                        autocomplete="off">
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="bg-black hover:bg-red-500 transition-colors text-white font-semibold rounded-md py-2 px-4 w-full">Próximo</button>
            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('.fade-in').addClass('show');
    });
</script>

</html>
