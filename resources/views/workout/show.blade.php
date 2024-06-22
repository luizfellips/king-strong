<x-workouts.layout>
    <div class="block md:grid md:grid-cols-2 md:gap-3">
        <div class="workout">
            <h1 class="workout-title mb-5 text-white text-4xl">{{ $workout->name }}</h1>
            <div class="workout-image rounded-xl">
                <img class="rounded-xl w-50"
                    src="https://static.vecteezy.com/system/resources/thumbnails/026/781/389/small_2x/gym-interior-background-of-dumbbells-on-rack-in-fitness-and-workout-room-photo.jpg"
                    alt="" srcset="">
            </div>
            <div class="workout-content py-4">
                <div class="workout-description p-3 bg-white text-black rounded-md mb-2">
                    <h2 class="text-lg py-2 font-bold text-black">Program Description</h2>
                    <p class="description text-gray-500">
                        {{ $workout->description }}
                    </p>
                </div>
                <x-workouts.workout.overview :levels="$levels" :goals="$goals" :workout="$workout" />
            </div>

            <div class="swiper rounded-lg text-black">
                <div class="swiper-wrapper">
                    @foreach ($workout->weeks as $week)
                        <div class="swiper-slide">
                            <div class="title flex bg-white rounded-xl rounded-b-none justify-between px-3 items-center">
                            <h1 class="text-lg p-3 font-bold">Week {{ $week->week_number }}</h1>
                            <span class="text-md font-normal text-gray-500">{{$week->week_number}} - {{$workout->length_in_weeks}} weeks</span>
                            </div>
                            <div class="days flex flex-col justify-center items-center">
                                @foreach ($week->days as $day)
                                    <div id="accordion-{{ $day->id }}" data-accordion="open" class="w-full">
                                        <h2 id="accordion-heading-{{ $day->id }}">
                                            <button type="button"
                                                class="flex items-center justify-between w-full p-5 rounded-t-none {{$loop->last ? 'rounded-b-xl' : 'rounded-b-none'}} font-medium rtl:text-right bg-white text-gray-500 border border-gray-200 rounded-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                                data-accordion-target="#accordion-body-{{ $day->id }}"
                                                aria-expanded="true" aria-controls="accordion-body-{{ $day->id }}">
                                                <span class="flex items-center"> Day {{ $day->day_number }}</span>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                </svg>
                                            </button>
                                        </h2>
                                        <div id="accordion-body-{{ $day->id }}" class="hidden bg-white {{$loop->last ? 'rounded-b-xl' : 'rounded-b-none'}} p-2"
                                            aria-labelledby="accordion-heading-{{ $day->id }}">
                                            @foreach ($day->dayExercises as $dayExercise)
                                                <div class="name flex gap-2 p-2">
                                                    <span class="text-red-500">{{ $loop->index + 1 }}</span>
                                                    <p>{{ $dayExercise->exercise->name }}</p>
                                                </div>

                                                <div class="sets flex justify-around text-gray-500">
                                                    <p>{{ $dayExercise->sets }} sets</p>
                                                    <p>{{ $dayExercise->reps }} reps</p>
                                                    <p>{{ '@' }}{{ $dayExercise->rpe }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
        <div class="banner hidden md:block">
            <div class="text-black text-center rounded-3xl bg-white flex justify-center items-center"
                style="height: 600px;
    width: 376px; position: fixed;">banner</div>
        </div>
    </div>
</x-workouts.layout>
