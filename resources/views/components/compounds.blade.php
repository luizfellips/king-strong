@props(['compounds'])
<div class="flex flex-col justify-center align-center mb-5">
    @foreach ($compounds as $compound)
        <button id="{{$compound->id}}" class="openModal bg-black my-2 text-white px-4 py-2 rounded">{{ $compound->name }}</button>
    @endforeach
</div>

<div id="myModal" class="modal">
    <div class="modal-content centered">
        <span id="closeModal" class="close absolute top-2 right-2 cursor-pointer text-gray-500">&times;</span>
        <h3 id="name" class="text-lg font-semibold mb-2"></h3>
        <img id="image" src="{{ asset('img/lifts/deadlift.png') }}" alt="">
        <p id="description" class="text-sm mt-3 text-gray-600"></p>
        <div class="">
            <p id="shortDescription" class="text-sm">O</p>
            <p class="text-sm mt-3 text-gray-600"></p>
            <div id="muscles">
            </div>

            <button id="closeModalButton"
                class="bg-black hover:bg-red-500 transition-colors text-white font-semibold rounded-md py-2 mt-5 px-4 w-full">Voltar</button>
                <form action="{{route('step4')}}" method="post">
                    @csrf
                    <input id="compound_id" name="compound_id" type="hidden" value="">
                <button
                class="bg-red-600 hover:bg-red-700 transition-colors text-white font-semibold rounded-md py-2 mt-5 px-4 w-full">Escolher</button>
                </form>

        </div>
    </div>
</div>
