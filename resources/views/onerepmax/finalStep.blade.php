<x-layout>
    <h1 class="text-2xl font-medium flex justify-center mb-12">Tabela de Porcentagem e Cargas</h1>
    <p class="text-base font-semibold mb-8">Você efetuou o exercício à <span class="text-red-600 text-lg px-1">
            {{ $percentOfRelativeIntensity }}%</span> da sua carga máxima.</p>
    <div class="flex justify-center">
        <x-onerepmax.table :results="$results" :percentOfRelativeIntensity="$percentOfRelativeIntensity" />
    </div>
    <a href="{{ route('onerepmax.step1') }}"><button
            class="bg-black hover:bg-slate-800 transition-colors text-white font-semibold rounded-md py-2 mt-5 px-4 w-full">Voltar</button></a>
</x-layout>
