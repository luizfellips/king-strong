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


    <div class="bg-gray-100 flex justify-center items-center">
        <div class="lg:p-36 md:p-52 sm:20 p-8 fade-in">
            <x-logo />
            <h1 class="text-2xl font-medium flex justify-center mb-12">Tabela de Porcentagem e Cargas</h1>
            <p class="text-sm font-semibold mb-8">Você efetuou o exercício à {{$percentOfRelativeIntensity}}% da sua carga máxima.</p>
            <div class="flex justify-center">
                <table class="min-w-full bg-white shadow-md rounded-xl table-auto">
                    <thead>
                        <tr class="bg-blue-gray-100 text-gray-700 table-row">
                            <th class="py-3 px-4 text-left">Carga Aprox.</th>
                            <th class="py-3 px-4 text-left">Repetições</th>
                            <th class="py-3 px-4 text-left">%1RM</th>
                        </tr>
                    </thead>
                    <tbody class="text-blue-gray-900">
                        @foreach ($results as $key => $value )
                        <tr class="border-b border-blue-gray-200">
                            <td class="py-3 px-4">{{$value}}kg</td>
                            <td class="py-3 px-4">{{ $loop->last ? 15 : $loop->index + 1 }}</td>
                            <td class="py-3 px-4">{{$key}}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('.fade-in').addClass('show');
    });
</script>

</html>
