<x-layout>
    <h1 class="text-2xl text-white text-center font-medium flex justify-center mb-12">Tabela de Porcentagem e Cargas</h1>
    <p class="text-sm sm:text-base text-white font-semibold text-center mb-8">Você efetuou o exercício à <span
            class="text-red-600 text-lg px-1">
            {{ $percentOfRelativeIntensity }}%</span> da sua carga máxima.</p>
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl pb-3 text-white text-center">{{$compound->name}}</h1>
        <x-onerepmax.table :results="$results" :percentOfRelativeIntensity="$percentOfRelativeIntensity" />
        <div class="flex w-full flex-col items-center p-3 justify-center bg-black text-white shadow-md rounded-xl mt-3">
            <div class="overflow-x-auto w-full">
                <table class="table-auto text-center hidden sm:table">
                    <thead>
                        <tr class="bg-blue-gray-100 text-sm sm:text-base text-white">
                            <th class="py-3 px-4 text-left">Nome</th>
                            <th class="py-3 px-4 text-left">Peso Corporal</th>
                            <th class="py-3 px-4 text-left">1RM Aprox.</th>
                            <th class="py-3 px-4 text-left">Proporção</th>
                            <th class="py-3 px-4 text-left">Categoria</th>
                            <th class="py-3 px-4 text-left">Gênero</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-3 px-4">{{ $lifter->name }}</td>
                            <td class="py-3 px-4">{{ $lifter->weight }}</td>
                            <td class="py-3 px-4">{{ floor($oneRepMax) }}</td>
                            <td class="py-3 px-4">{{ round($weightRatio, 2) }}</td>
                            <td class="py-3 px-4">{{ $trainingLevel ? ucfirst($trainingLevel) : 'Não Avaliado' }}</td>
                            <td class="py-3 px-4">{{ $lifter->gender == 'M' ? 'Masculino' : 'Feminino' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        
            <!-- Responsive Card Layout for smaller screens -->
            <div class="sm:hidden w-full">
                <div class="background text-sm text-white p-4 rounded-lg">
                    <h2 class="text-xl">Suas Informações</h2>
                    <div class="py-2 flex justify-between mt-2 border-gray-600">
                        <span class="font-bold">Nome:</span> {{ $lifter->name }}
                    </div>
                    <div class="py-2 flex justify-between mt-2 border-t border-gray-600">
                        <span class="font-bold">Peso Corporal:</span> {{ $lifter->weight }}
                    </div>
                    <div class="py-2 flex justify-between mt-2 border-t border-gray-600">
                        <span class="font-bold">1RM Aprox.:</span> {{ floor($oneRepMax) }}
                    </div>
                    <div class="py-2 flex justify-between mt-2 border-t border-gray-600">
                        <span class="font-bold">Proporção:</span> {{ round($weightRatio, 2) }}
                    </div>
                    <div class="py-2 flex justify-between mt-2 border-t border-gray-600">
                        <span class="font-bold">Categoria:</span> {{ $trainingLevel ? ucfirst($trainingLevel) : 'Não Avaliado' }}
                    </div>
                    <div class="py-2 flex justify-between mt-2 border-t border-gray-600">
                        <span class="font-bold">Gênero:</span> {{ $lifter->gender == 'M' ? 'Masculino' : 'Feminino' }}
                    </div>
                </div>
            </div>
        </div>
        
        @unless ($compound->id === 4)
            <div class="sm:w-full flex flex-col items-center p-3 justify-center background text-white shadow-md rounded-xl mt-3">
                <h1 class="text-xl">Quão forte você deveria ser?</h1>
                <h2 class="text-xl text-red-600 font-bold text-center p-1">{{ ucfirst($standards['trainingLevel']) }}</h2>
                @switch($standards['yearsOfLifting'])
                    @case('two_to_five_years')
                        <h2 class="text-base p-1 text-center">Média de 1RM Entre <span class="font-bold">2 e 5 anos de
                                treino</span>:</h2>
                    @break
                    @case('up_to_two_years')
                        <h2 class="text-base p-1 text-center">Média de 1RM Entre <span class="font-bold">6 meses e 2 anos
                                de treino:</span>:</h2>
                    @break

                    @case('three_to_six_months')
                        <h2 class="text-base text-white p-1 text-center">Média de 1RM Entre <span class="font-bold">3 e 6 meses de treino</span>:</h2>
                    @break

                    @case('five_or_more_years')
                        <h2 class="text-base text-white p-1 text-center">Média de 1RM Entre <span class="font-bold">5 ou mais anos de treino:</span>:</h2>
                    @break

                    @case('ten_or_more_years')
                        <h2 class="text-base text-white p-1 text-center">Média de 1RM Entre <span class="font-bold">10 ou mais anos de treino:</span>:</h2>
                    @break
                    @default
                @endswitch
                <div class="flex flex-row py-1">
                    <div class="card text-center border-black px-5">
                        <h1 class="title text-2xl text-white">{{ $compound->name }}</h1>
                        <p class="text-xl text-white bg-red-700 rounded-md p-2">{{ $standards['minRatio'] }}x -
                            {{ $standards['maxRatio'] }}x</p>
                        <p class="pt-3">Ex.:</p>
                        @foreach ($example as $key => $value)
                        @if ($lifter->gender === 'M')
                        <p class="pt-1">Um homem de {{ $key }}kg deve erguer um peso entre
                            {{ $value[0] }}kg e {{ $value[1] }}kg</p>
                        <p>para ser considerado <span
                                class="text-red-600 font-bold">{{ ucfirst($standards['trainingLevel']) }}.</span></p>
                        @else
                        <p class="pt-1">Uma mulher de {{ $key }}kg deve erguer um peso entre
                            {{ $value[0] }}kg e {{ $value[1] }}kg</p>
                        <p>para ser considerada <span
                                class="text-red-600 font-bold">{{ ucfirst($standards['trainingLevel']) }}.</span></p>
                        @endif
                            
                        @endforeach
                    </div>
                </div>
            </div>
        @endunless

    </div>
    <a href="{{ route('onerepmax.step1') }}"><button
            class="bg-black hover:bg-slate-800 transition-colors text-white font-semibold rounded-md py-2 flex justify-around shadow-lg mt-5 px-4 w-full">Voltar</button></a>
</x-layout>
