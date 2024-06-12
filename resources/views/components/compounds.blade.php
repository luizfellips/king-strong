@props(['compounds', 'lifter'])
<div class="flex flex-col justify-center align-center mb-5">
    @foreach ($compounds as $compound)
        <button id="{{ $compound->id }}"
            class="openModal bg-black my-2 hover:bg-red-700 transition-colors text-white px-4 py-2 rounded">{{ $compound->name }}</button>
    @endforeach
</div>

<!-- Modal skeleton -->
<div id="myModal" class="modal">
    <div class="modal-content centered">
        <span id="closeModal" class="close absolute top-2 right-2 cursor-pointer text-gray-500">&times;</span>
        <h3 id="name" class="text-lg font-semibold mb-2"></h3>
        <img id="image" src="" alt="">
        <p id="description" class="text-sm mt-3"></p>
        <div class="">
            <p id="shortDescription" class="text-sm text-gray-600">O</p>
            <p class="text-sm mt-3 text-gray-600"></p>
            <div id="muscles">
                <span
                    class="bg-red-300 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900"></span>
            </div>
            <button id="closeModalButton"
                class="bg-black hover:bg-slate-800 transition-colors text-white font-semibold rounded-md py-2 mt-5 px-4 w-full">Voltar</button>
            <form action="{{ route('onerepmax.step4') }}" method="post">
                @csrf
                <input id="compound_id" name="compound_id" type="hidden" value="">
                <input id="lifter_id" name="lifter_id" type="hidden" value="{{$lifter->id}}">
                <x-button :alt='true'>Escolher</x-button>
            </form>
        </div>
    </div>
</div>
