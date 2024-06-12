    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <x-layout>
        <h1 class="text-2xl font-medium flex justify-center mb-12">Calcule suas porcentagens de 1RM!</h1>
        <form action="{{ route('onerepmax.step2') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="name" class="block text-gray-600">Qual o seu nome?</label>
                <input required type="text" id="name" name="name"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-black"
                    autocomplete="off">
            </div>
            <x-button> Próximo </x-button>
        </form>
    </x-layout>
