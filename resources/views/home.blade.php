<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/css/app.css')
    <style>
        .button-24 {
            background-color: initial;
            border: 1px solid #FF4742;
            border-radius: 6px;
            box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
            box-sizing: border-box;
            color: #FF4742;
            cursor: pointer;
            display: inline-block;
            font-family: nunito, roboto, proxima-nova, "proxima nova", sans-serif;
            font-size: 16px;
            font-weight: 800;
            line-height: 16px;
            min-height: 40px;
            outline: 0;
            padding: 12px 14px;
            text-align: center;
            text-rendering: geometricprecision;
            text-transform: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            transition: 0.2s;
        }

        .button-24:hover,
        .button-24:active {
            background-color: #FF4742;
            background-position: 0 0;
            color: white;
        }

        .button-24:active {
            opacity: .5;
        }

        .background {
            background: rgb(50, 5, 5);
            background: linear-gradient(0deg, rgba(50, 5, 5, 1) 0%, rgba(0, 0, 0, 1) 69%);
        }

        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in;
        }

        .fade-in.show {
            opacity: 1;
        }
    </style>
    <title>King Strong</title>
</head>

<body class="background fade-in text-white font-sans flex flex-col justify-center items-center min-h-screen">
    <!-- Navbar -->
    <header class="w-full py-4">
        <div class="container mx-auto px-4 flex flex-col sm:flex-row pb-3 justify-around items-center">
            <div class="text-2xl font-bold text-gray-800">
                <x-logo />
            </div>
            <nav class="flex flex-wrap ps-6 sm:pe-12 flex-row sm:flex-row md:justify-around gap-12">
                <a href="#" class="text-white  transition-all hover:text-red-600">Início</a>
                <a href="#" class="text-white  transition-all hover:text-red-600">Serviços</a>
                <a href="#" class="text-white  transition-all hover:text-red-600">Contatos</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto pb-4 px-4 flex-grow">
        <div class="flex flex-col-reverse md:flex-row items-center justify-center h-full">
            <!-- Left Column (Call to Action) -->
            <div class="text-center md:text-left sm:pb-32 mb-12 md:mb-0">
                <h1 class="text-4xl font-bold mb-6">King Strong</h1>
                <p class="text-lg mb-8">Experimente nossas ferramentas de análise e potencialize seu treino.</p>
                <div class="flex flex-wrap flex-col sm:flex-row justify-around gap-5">
                    <a href="{{ route('onerepmax.step1') }}" class="button-24 px-6 py-2 rounded-lg mb-4">One
                        Rep Max</a>
                    <a href="{{ route('workouts.index') }}" class="button-24 px-6 py-2 rounded-lg mb-4">Programas de Treinamento</a>
                    <a href="#" class="button-24 px-6 py-2 rounded-lg mb-4">Lorem ipsum</a>
                </div>
            </div>

            <!-- Right Column (Logo) -->
            <div class="flex items-center justify-center">
                <img src="{{ asset('img/kong.png') }}" alt="Logo" class=" w-full object-cover">
            </div>
        </div>
    </main>
</body>
<script>
    $(document).ready(function() {
        $('.fade-in').addClass('show');
    });
</script>

</html>
