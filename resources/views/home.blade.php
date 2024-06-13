<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <style>
        .background {
            background-color: #1c1c1b;
        }
    </style>
</head>

<body class="background text-white font-sans flex flex-col justify-center items-center min-h-screen">
    <!-- Navbar -->
    <header class="w-full py-4">
        <div class="container mx-auto px-4 flex flex-col sm:flex-row pb-3 justify-around items-center">
            <div class="text-2xl font-bold text-gray-800">
                <x-logo :alt="true" />
            </div>
            <nav class="flex flex-wrap flex-row sm:flex-row md:justify-between gap-5">
                <a href="#" class="text-white mx-3 transition-all hover:text-red-600">Início</a>
                <a href="#" class="text-white mx-3 transition-all hover:text-red-600">Serviços</a>
                <a href="#" class="text-white mx-3 transition-all hover:text-red-600">Contatos</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto pb-4 px-4 flex-grow">
        <div class="flex flex-col md:flex-row items-center justify-center h-full">
            <!-- Left Column (Call to Action) -->
            <div class="text-center md:text-left sm:pb-32 mb-12 md:mb-0">
                <h1 class="text-4xl font-bold mb-6">Power Maromba</h1>
                <p class="text-lg mb-8">Experimente nossas ferramentas e potencialize seu treino.</p>
                <div class="flex flex-wrap flex-col sm:flex-row justify-around md:justify-between gap-5">
                    <a href="{{route('onerepmax.step1')}}"
                        class="bg-red-700 text-white px-6 py-3  rounded-lg font-semibold shadow-md hover:bg-red-900 mb-4">One
                        Rep Max</a>
                    <a href="#"
                        class="bg-red-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-red-900 mb-4">Análise de Treino</a>
                    <a href="#"
                        class="bg-red-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-red-900 mb-4">Cinesiologia</a>
                </div>
            </div>

            <!-- Right Column (Logo) -->
            <div class="flex items-center justify-center">
                <img src="{{ asset('img/bull.png') }}" alt="Logo" class=" w-full object-cover">
            </div>
        </div>
    </main>
</body>

</html>
