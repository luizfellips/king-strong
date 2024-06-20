<x-workouts.layout>
    <div class="search-row flex items-center gap-2">
        <x-workouts.search-form />
        <x-workouts.filter.filter />
    </div>

    <x-workouts.filter.filter-options :levels="$levels" :goals="$goals" />

    <div class="workouts py-2 flex flex-col justify-center items-center">
        @foreach ($workouts as $workout)
            <x-workouts.workout.workout :workout="$workout" />
        @endforeach
    </div>

</x-workouts.layout>
