<x-layout>
    <h1 class="text-1xl sm:text-2xl text-white font-medium flex justify-center mb-12">Insira seu recorde pessoal no {{ $compound->name }}.</h1>
    <form class="preventive" action="{{ route('onerepmax.processStep4') }}" method="POST">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger my-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="bg-red-700 my-2 text-white rounded-xl p-3">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input id="compound_slug" type="hidden" name="compound_slug" value="{{ $compound->slug }}"> 
    <input id="lifter_slug" type="hidden" name="lifter_slug" value="{{ $lifter->slug }}"> 
        <div class="mb-5">
            <div class="mb-4">
                <label class="block text-white pb-1">Quantos quilogramas(kg) foram levantados ao todo?</label>
                <input type="text" id="compoundWeight" name="compoundWeight" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 mb-2 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 140">
            </div>

            <div class="mb-4">
                <label class="block text-white pb-1">Quantas repetições foram realizadas?</label>
                <input type="text" id="reps" name="reps" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 6">
            </div>

            <div class="mb-4">
                <label class="block text-white pb-1">Quantas repetições adicionais você sente que ainda poderia ter realizado?</label>
                <input type="text" id="repsInReserve" name="repsInReserve" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 2">
            </div>

        </div>

        <x-button :isDark="true">Calcular</x-button>
    </form>
</x-layout>
