<x-layout>
    <h1 class="text-2xl font-medium flex justify-center mb-12">Olá {{ $lifter->name }}!</h1>
    <form action="{{ route('onerepmax.step3') }}" method="POST">
        @csrf
        <input type="hidden" name="lifter_id" value="{{ $lifter->id }}">

        <div class="mb-5">
            <div class="mb-4">
                <label class="block text-gray-600">Qual a sua altura em cm?</label>
                <input type="text" id="height" name="height"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 mb-2 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 180">
            </div>

            <div class="mb-4">
                <label class="block text-gray-600">Qual o seu peso em kg?</label>
                <input type="text" id="weight" name="weight"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 65">
            </div>

        </div>
        <x-button> Próximo </x-button>
    </form>
</x-layout>
