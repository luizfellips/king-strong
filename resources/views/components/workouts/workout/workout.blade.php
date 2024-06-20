@props(['workout'])

<div class="workout my-3">
    <div class="workout-image rounded-t-xl">
        <img class="rounded-t-xl" src="https://static.vecteezy.com/system/resources/thumbnails/026/781/389/small_2x/gym-interior-background-of-dumbbells-on-rack-in-fitness-and-workout-room-photo.jpg" alt="" srcset="">
    </div>
    <div class="workout-content bg-white py-5 rounded-b-xl text-black">
        <div class="workout-title p-2 rounded-b-xl">
            {{$workout->name}}
        </div>
        <div class="workout-level-goals-tags flex flex-row gap-2 justify-between">
            <div class="goal-tags text-xs flex gap-2 px-3">
                @foreach ($workout->goals as $goal)
                    <div class="tag bg-red-200 text-red-700 p-2 rounded-3xl">{{$goal->name}}</div>
                @endforeach
            </div>
            <div class="level-tags text-xs flex gap-2 px-3">
                @foreach ($workout->levels as $level)
                    <div class="tag bg-blue-200 text-blue-700 p-2 rounded-3xl">{{$level->name}}</div>
                @endforeach
            </div>
        </div>
        <div class="workout-duration-tags mt-2 flex flex-col justify-center align-middle items-start gap-2">
            <div class="duration-tag text-xs px-3">
                    <div class="tag bg-purple-200 text-purple-700 p-1 rounded-2xl">{{$workout->minutes_per_workout}} minutes per workout</div>
            </div>
            <div class="days-per-week-tags text-xs px-3">
                    <div class="tag bg-purple-200 text-purple-700 p-2 rounded-2xl">{{$workout->workouts_per_week}} days/week</div>
            </div>
            <div class="week-tags text-xs px-3">
                <div class="tag bg-purple-200 text-purple-700 p-2 rounded-2xl">{{$workout->length_in_weeks}} weeks</div>
        </div>
        </div>
    </div>
</div>
