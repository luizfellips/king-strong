<x-onerepmax.layout>
    <a href="{{ route('home') }}">
    </a>
    <h1 class="text-2xl  text-white font-medium flex justify-center mb-12">Calcule suas porcentagens de 1RM!</h1>
    <form class="preventive" action="{{ route('onerepmax.processStep1') }}" method="POST">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger my-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="bg-red-700 text-center text-white rounded-xl p-3">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="mb-5">
            <label for="name" class="block text-white">Qual o seu nome?</label>
            <input required type="text" id="name" name="name"
                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                autocomplete="off">
        </div>
        <x-onerepmax.button :isDark="true"> Próximo </x-onerepmax.button>
        <x-onerepmax.link-button :route="route('home')"> Voltar </x-onerepmax.link-button>
    </form>
</x-onerepmax.layout>
