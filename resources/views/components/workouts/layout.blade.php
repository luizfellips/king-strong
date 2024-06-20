<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/workouts/page.css') }}">
    <title>Programas de Treinamento</title>
</head>

<body class="background text-white min-h-screen">
    <x-workouts.navbar />
    <div class="content w-full mt-24 px-8 sm:px-32">
        {{ $slot }}
    </div>
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script src="{{ asset('js/workouts/filter.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/workoutsapi',
                method: 'GET',
                success: function(response) {
                    renderWorkouts(response.data); // Render workout items based on response
                },
                error: function(error) {
                    console.error('Error fetching workouts:', error);
                }
            });
        });

        $(document).ready(function() {
            var filters = {
                levels: [],
                goals: [],
                workouts_per_week: [],
            };

            // Toggle filter and perform AJAX request
            $('.filter-option').click(function() {
                var filterType = $(this).data('filter-type');
                var filterId = $(this).data('id');

                // Toggle the active state for the clicked filter option
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active text-white');
                    $(this).removeClass(function(index, className) {
                        return (className.match(/(^|\s)bg-\S+/g) || []).join(' ');
                    });
                    filters[filterType] = filters[filterType].filter(function(id) {
                        return id !== filterId;
                    });
                } else {
                    // Add active class and corresponding background color
                    $(this).addClass('active');
                    if ($(this).hasClass('level-button')) {
                        $(this).addClass('bg-red-500 text-white');
                    } else if ($(this).hasClass('goal-button')) {
                        $(this).addClass('bg-blue-500 text-white');
                    } else if ($(this).hasClass('day-button')) {
                        $(this).addClass('bg-yellow-500 text-white');
                    }
                    
                    filters[filterType].push(filterId);
                }

                // Perform AJAX request here
                // Add your AJAX logic to fetch filtered data
                $.ajax({
                    url: '/api/workoutsapi',
                    method: 'GET',
                    data: filters,
                    success: function(response) {
                        renderWorkouts(response.data); // Render workout items based on response
                    },
                    error: function(error) {
                        console.error('Error fetching workouts:', error);
                    }
                });
            });
        });

        function renderWorkouts(workouts) {
            $('#workoutResults').empty(); // Clear previous results


            workouts.forEach(function(workout) {
                var workoutHtml = `
                <div class="workout my-3">
                    <div class="workout-image rounded-t-xl">
                        <img class="rounded-t-xl" src="https://static.vecteezy.com/system/resources/thumbnails/026/781/389/small_2x/gym-interior-background-of-dumbbells-on-rack-in-fitness-and-workout-room-photo.jpg" alt="" srcset="">
                    </div>
                    <div class="workout-content bg-white py-5 rounded-b-xl text-black">
                        <div class="workout-title p-2 rounded-b-xl">${workout.name}</div>
                        <div class="workout-level-goals-tags flex flex-row gap-2 justify-between">
                            <div class="goal-tags text-xs flex gap-2 px-3">
                                ${workout.goals.map(goal => `<div class="tag bg-red-200 text-red-700 p-2 rounded-3xl">${goal}</div>`).join('')}
                            </div>
                            <div class="level-tags text-xs flex gap-2 px-3">
                                ${workout.levels.map(level => `<div class="tag bg-blue-200 text-blue-700 p-2 rounded-3xl">${level}</div>`).join('')}
                            </div>
                        </div>
                        <div class="workout-duration-tags mt-2 flex flex-col justify-center align-middle items-start gap-2">
                            <div class="duration-tag text-xs px-3">
                                <div class="tag bg-purple-200 text-purple-700 p-2 rounded-2xl">${workout.minutesPerWorkout} minutes per workout</div>
                            </div>
                            <div class="days-per-week-tags text-xs px-3">
                                <div class="tag bg-purple-200 text-purple-700 p-2 rounded-2xl">${workout.workoutsPerWeek} days/week</div>
                            </div>
                            <div class="week-tags text-xs px-3">
                                <div class="tag bg-purple-200 text-purple-700 p-2 rounded-2xl">${workout.lengthInWeeks} weeks</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                $('#workoutResults').append(workoutHtml);
            });
        }
    </script>
</body>

</html>
