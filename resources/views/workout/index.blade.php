<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <title>Programas de Treinamento</title>
</head>

<body>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow workouts p-6">
            <h2 class="text-xl font-bold mb-4 border-b">Programas de Treino</h2>
            @foreach ($workouts as $workout)
                <div class="workout p-5 mb-5">

                    <div class="workout-title text-black font-bold text-lg">
                        <h1>{{ $workout->name }}</h1>
                    </div>

                    <div class="attributes">
                        <ul class="px-3">
                            <li>Description: {{ $workout->description }}</li>
                            <li>Length in weeks: {{ $workout->length_in_weeks }} weeks</li>
                            <li>Workouts per week: {{ $workout->workouts_per_week }} workouts</li>
                            <li>Minutes per workout: {{ $workout->minutes_per_workout }} minutes</li>
                        </ul>
                    </div>

                    <div class="levels">
                        <h1 class="text-black font-semibold">Levels</h1>
                        <ul class="px-3">
                            @foreach ($workout->levels as $level)
                                <li>{{ $level->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="goals">
                        <h1 class="text-black font-semibold">Goals</h1>
                        <ul class="px-3">
                            @foreach ($workout->goals as $goal)
                                <li>{{ $goal->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="program">
                        <h1 class="text-black font-semibold">Program</h1>
                        <div class="px-3">
                            @foreach ($workout->weeks as $week)
                                <div class="week">
                                    <h1 class="text-black font-semibold">Week {{ $week->week_number }}</h1>
                                    <div class="px-3">
                                        @foreach ($week->days as $day)
                                            <div>
                                                <h1 class="text-black font-semibold">Day {{ $day->day_number }}</h1>
                                                <div class="">
                                                    @foreach ($day->dayExercises as $dayExercise)
                                                        <div class="Exercise px-2 border-b">
                                                            <h1 class="text-black font-semibold"> {{ $dayExercise->exercise->name }}
                                                                {{ $dayExercise->sets }}x{{ $dayExercise->reps }} RPE
                                                                {{ '@' }}{{ $dayExercise->rpe }}
                                                            </h1>
                                                            <p class="px-1 text-black font-semibold">Músculos alvos: </p>
                                                            <ul class="px-3">
                                                                @foreach ($dayExercise->exercise->targetMuscles as $targetMuscle)
                                                                    <li>{{$targetMuscle->name}}</li>
                                                                @endforeach
                                                            </ul>
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
            @endforeach
        </div>
        <div class="exercises bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4 border-b">Exercícios</h2>
            @foreach ($exercises as $exercise)
                <div class="exercise p-5 mb-5">

                    <div class="exercise-title text-black font-bold text-lg">
                        <h1>{{ $exercise->name }}</h1>
                    </div>

                    <div class="targetMuscles">
                        <h1 class="text-black font-semibold">Músculos Alvos</h1>
                        <ul class="px-3">
                            @foreach ($exercise->targetMuscles as $targetMuscle)
                                <li>{{ $targetMuscle->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
