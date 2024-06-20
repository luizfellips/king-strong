<x-workouts.layout>
    <div class="search-row flex items-center gap-2">
        <x-workouts.search-form />
        <x-workouts.filter.filter />
    </div>

    <x-workouts.filter.filter-options :levels="$levels" :goals="$goals" />

    <div id="workoutResults" class="workouts py-2 flex flex-col justify-center items-center">
    </div>

</x-workouts.layout>
