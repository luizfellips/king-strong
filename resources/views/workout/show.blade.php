<x-workouts.layout>
    <div class="block overflow-x-hidden mb-3 md:grid md:grid-cols-2 md:gap-3">

        <div class="workout">
            <a href="{{ route('workouts.index') }}">
                <button class="bg-red-700 text-white p-2 rounded-xl">
                    < </button>
            </a>
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
                        {!! html_entity_decode($workout->description)!!}
                    </p>
                </div>
                <x-workouts.workout.overview :levels="$levels" :goals="$goals" :workout="$workout" />
            </div>

            <div class="xl:hidden swiper rounded-lg text-black">
                <div class="swiper-wrapper">
                    @foreach ($workout->weeks as $week)
                        <div class="swiper-slide">
                            <div
                                class="title flex bg-white rounded-xl rounded-b-none justify-between px-3 items-center">
                                <h1 class="text-lg p-3 font-bold">Week {{ $week->week_number }}</h1>
                                <span class="text-md font-normal text-gray-500">{{ $week->week_number }} -
                                    {{ $workout->length_in_weeks }} weeks</span>
                            </div>
                            <div class="days flex flex-col justify-center items-center">
                                @foreach ($week->days as $day)
                                    <div id="accordion-{{ $day->id }}" data-accordion="open" class="w-full">
                                        <h2 id="accordion-heading-{{ $day->id }}">
                                            <button type="button"
                                                class="flex items-center justify-between w-full p-5 rounded-t-none rounded-b-none font-medium rtl:text-right bg-white text-gray-500 border border-gray-200 rounded-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
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
                                        <div id="accordion-body-{{ $day->id }}"
                                            class="hidden bg-white {{ $loop->last ? 'rounded-b-xl' : 'rounded-b-none' }} p-2"
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

            <div class="hidden xl:block overflow-x-auto w-full text-black">
                <div class="flex flex-row justify-between">
                    @foreach ($workout->weeks as $week)
                        <div class="mx-1 flex-1 min-w-[300px]"> <!-- Adjusted width and flex properties -->
                            <div>
                                <h1 class="text-lg p-3 font-bold text-white">Week {{ $week->week_number }}
                                </h1>
                            </div>
                            <div class="days flex flex-col justify-center items-center">
                                @foreach ($week->days as $day)
                                    <div class="w-full mb-4"> <!-- Added margin-bottom for spacing -->
                                        <h2 class="text-black text-lg border-b border-spacing-1 p-2 bg-white rounded-t-lg">
                                            Day {{ $day->day_number }}
                                        </h2>
                                        <div class="clues flex justify-start gap-2 px-4 bg-white">
                                            <p class="text-gray-500 bg-white">#</p>
                                            <p class="text-gray-500 bg-white">Exercise</p>
                                        </div>
                                        <div class="exercises h-96 bg-white rounded-b-xl p-2">
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



            <div class="workout-guide mt-2 bg-white text-gray-500 p-5 rounded-lg">
                <h1 class="text-black font-bold text-xl">Program Guide</h1>
                <p class="workout-content">
                    @php
                        $guide = $workout->guide ? $workout->guide : 'There is no guide available for this workout.';
                    @endphp
                    {!! html_entity_decode($guide)!!}
                </p>
            </div>


        </div>
        <div class="suggestions hidden md:block">
        </div>
    </div>
</x-workouts.layout>
