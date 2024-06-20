<x-onerepmax.layout>


    <h1 class="text-2xl font-medium text-white flex justify-center mb-12">Olá {{ $lifter->name }}!</h1>
    <form class="preventive" action="{{ route('onerepmax.processStep2') }}" method="POST">
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
        <input type="hidden" name="lifter_slug" value="{{ $lifter->slug }}">

        <div class="mb-5">
            <div class="mb-4">
                <label class="block text-white">Qual a sua altura em cm?</label>
                <input type="text" id="height" name="height"
                    class="numeric w-full border text-start border-gray-300 rounded-md py-2 px-3 mb-2 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 180">
            </div>

            <div class="mb-4">
                <label class="block text-white">Qual o seu peso em kg?</label>
                <input type="text" required id="weight" name="weight"
                    class="numeric w-full border text-start border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                    autocomplete="off" placeholder="ex.: 65">
            </div>

            <div class="mb-4">
                <label for="options" class="block text-white">Há quanto tempo você treina?</label>
                <select id="options" name="years_of_lifting" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black">
                    <option value="" disabled selected>Selecione uma opção</option>
                    <option value="three_to_six_months">3 a 6 meses</option>
                    <option value="up_to_two_years">6 meses a 2 anos</option>
                    <option value="two_to_five_years">2 a 5 anos</option>
                    <option value="five_or_more_years">5 anos ou mais</option>
                    <option value="ten_or_more_years">10 anos ou mais</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="options" class="block text-white">Qual o seu gênero?</label>
                <select id="options" name="gender" required
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black">
                    <option value="" disabled selected>Selecione uma opção</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
        </div>
        <x-onerepmax.button :isDark="true"> Próximo </x-onerepmax.button>
    </form>
    <script>
         $(document).ready(function(){
            $('.numeric').inputmask({
                alias: 'numeric',
                allowMinus: false,
                rightAlign: false,
                placeholder: '',
            });
        });
    </script>
</x-onerepmax.layout>
