<x-layout>
    <h1 class="text-2xl font-medium flex justify-center mb-12">Insira seu recorde pessoal no {{ $compound->name }}.</h1>
    <form action="{{ route('onerepmax.process') }}" method="POST">
        @csrf
        <input id="compound_id" name="compound_id" type="hidden" value="{{$compound->id}}">
        <input id="lifter_id" name="lifter_id" type="hidden" value="{{$lifter->id}}">
        <div class="mb-5">
            <div class="mb-4">
                <label class="block text-gray-600">Quantos quilogramas(kg) foram levantados ao todo?</label>
                <input type="text" id="compoundWeight" name="compoundWeight" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 mb-2 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 140">
            </div>

            <div class="mb-4">
                <label class="block text-gray-600">Quantas repetições foram realizadas?</label>
                <input type="text" id="reps" name="reps" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 6">
            </div>

            <div class="mb-4">
                <label class="block text-gray-600">Quantas repetições adicionais você sente que ainda poderia ter realizado?</label>
                <input type="text" id="repsInReserve" name="repsInReserve" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 2">
            </div>

        </div>

        <x-button>Calcular</x-button>
    </form>
</x-layout>
