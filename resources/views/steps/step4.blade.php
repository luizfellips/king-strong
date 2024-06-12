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
    <div class="bg-gray-100 flex justify-center items-center h-screen">
        <div class="lg:p-36 md:p-52 sm:20 p-8 fade-in">
            <x:logo />
            <h1 class="text-2xl font-medium flex justify-center mb-12">Insira seu recorde pessoal no {{$compound->name}}.</h1>
            <form action="{{route('process')}}" method="POST">
                @csrf
                <div class="mb-5">
                    <div class="mb-4">
                        <label class="block text-gray-600">Qual foi o total erguido em kg?</label>
                        <input type="text" id="compoundWeight" name="compoundWeight"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 mb-2 focus:outline-none focus:border-black"
                            autocomplete="off" placeholder="ex.: 140">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Quantas repetições?</label>
                        <input type="text" id="reps" name="reps"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                            autocomplete="off" placeholder="ex.: 6">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Quantas você acha que ainda daria pra ter feito?</label>
                        <input type="text" id="repsInReserve" name="repsInReserve"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                            autocomplete="off" placeholder="ex.: 2">
                    </div>

                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="bg-black hover:bg-red-500 transition-colors text-white font-semibold rounded-md py-2 mt-5 px-4 w-full">Calcular</button>
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
