@props(['levels', 'goals', 'workout'])
<div class="overview rounded-md p-2 bg-white">
    <h2 class="text-lg py-2 font-bold text-black">Program Overview</h2>
    <div class="data-row flex border-b justify-between items-center text-black">
        <p class="text-gray-500">Level</p>
        <div class="levels flex gap-2">
            <p class="level  p-1 rounded-xl">{{ $levels }}</p>
        </div>
    </div>
    <div class="data-row flex my-3 border-b justify-between items-center text-black">
        <p class="text-gray-500">Goal</p>
        <div class="goals flex gap-2">
                <p class="goal p-1 rounded-xl">{{ $goals }}</p>
        </div>
    </div>
    <div class="data-row flex mb-2 border-b justify-between items-center text-black">
        <p class="text-gray-500">Program length</p>
        <p class=" p-1 rounded-xl">{{ $workout->length_in_weeks }} weeks</p>
    </div>
    <div class="data-row flex mb-2 border-b justify-between items-center text-black">
        <p class="text-gray-500">Days per week</p>
        <p class=" p-1 rounded-xl">{{ $workout->workouts_per_week }} days</p>
    </div>
    <div class="data-row flex justify-between items-center text-black">
        <p class="text-gray-500">Minutes per workout</p>
        <p class=" p-1 rounded-xl">{{ $workout->minutes_per_workout }} minutes</p>
    </div>
</div>