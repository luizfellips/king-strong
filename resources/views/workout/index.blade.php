<x-workouts.layout>
    <div class="search-row flex items-center md:px-36 justify-center gap-2">
        <x-workouts.search-form />
        <x-workouts.filter.filter />
    </div>

    <x-workouts.filter.filter-options :levels="$levels" :goals="$goals" />

    <!-- To be populated by request !-->
    <div id="workoutResults" class="workouts py-2 flex flex-col md:grid md:grid-cols-3 md:space-x-4 justify-center items-center"></div>

</x-workouts.layout>
