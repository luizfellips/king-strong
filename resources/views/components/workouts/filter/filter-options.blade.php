@props(['levels', 'goals'])

<div id="filterOptions" class="justify-center sm:items-center mt-6 flex-col hidden gap-4">
    <div class="levels">
        <p class="text-gray-200 mb-2 text-sm">Training level</p>
        <div class="flex max-w-full snap-x snap-mandatory space-x-3 overflow-scroll p-2 px-1">
            @foreach ($levels as $level)
                <div
                    class="shrink-0 snap-start scroll-ml-4 border border-opacity-50 border-red-400 rounded-3xl p-2 text-xs text-red-500">
                    {{ $level->name }}</div>
            @endforeach
        </div>
    </div>
    <div class="levels">
        <p class="text-gray-200 mb-2 text-sm">Goals</p>
        <div class="flex max-w-full snap-x snap-mandatory space-x-3 overflow-scroll p-2 px-1">
            @foreach ($goals as $goal)
                <div
                    class="shrink-0 snap-start scroll-ml-4 border border-opacity-50 border-blue-400 rounded-3xl p-2 text-xs text-blue-500">
                    {{ $goal->name }}</div>
            @endforeach
        </div>
    </div>
    <div class="workoutsPerWeek">
        <p class="text-gray-200 mb-2 text-sm">Workouts per week</p>
        <div class="flex max-w-full snap-x snap-mandatory space-x-3 overflow-scroll p-2 px-1">
            <div
                class="shrink-0 snap-start scroll-ml-4 border border-opacity-50 border-yellow-400 rounded-3xl p-2 text-xs text-yellow-500">
                2 days</div>
            <div
                class="shrink-0 snap-start scroll-ml-4 border border-opacity-50 border-yellow-400 rounded-3xl p-2 text-xs text-yellow-500">
                3 days</div>
            <div
                class="shrink-0 snap-start scroll-ml-4 border border-opacity-50 border-yellow-400 rounded-3xl p-2 text-xs text-yellow-500">
                4 days</div>
            <div
                class="shrink-0 snap-start scroll-ml-4 border border-opacity-50 border-yellow-400 rounded-3xl p-2 text-xs text-yellow-500">
                5 days</div>
            <div
                class="shrink-0 snap-start scroll-ml-4 border border-opacity-50 border-yellow-400 rounded-3xl p-2 text-xs text-yellow-500">
                6 days</div>

        </div>
    </div>
</div>
