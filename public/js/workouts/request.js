$(document).ready(function () {
    $.ajax({
        url: '/api/workoutsapi',
        method: 'GET',
        success: function (response) {
            renderWorkouts(response.data); // Render workout items based on response
        },
        error: function (error) {
            console.error('Error fetching workouts:', error);
        }
    });
});

$(document).ready(function () {
    $('#search-form').on('submit', function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '/api/workoutsapi',
            type: 'GET', 
            data: formData,
            success: function (response) {
                renderWorkouts(response.data);
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});

$(document).ready(function () {
    // Toggle filter and perform AJAX request
    $('.filter-option').click(function () {
        var filterType = $(this).data('filter-type');
        var filterId = $(this).data('id');

        filters = getFilterOptions($(this), filterType, filterId);

        $.ajax({
            url: '/api/workoutsapi',
            method: 'GET',
            data: filters,
            success: function (response) {
                renderWorkouts(response.data);
            },
            error: function (error) {
                console.error('Error fetching workouts:', error);
            }
        });
    });
});

function getFilterOptions(filterObject, filterType, filterId) {
    var filters = {
        levels: [],
        goals: [],
        workouts_per_week: [],
    };

    // Toggle the active state for the clicked filter option
    if (filterObject.hasClass('active')) {
        filterObject.removeClass('active text-white');
        if (filterObject.hasClass('bg-yellow-500')) {
            filterObject.removeClass('text-white').addClass('text-yellow-500');
        }
        filterObject.removeClass(function (index, className) {
            return (className.match(/(^|\s)bg-\S+/g) || []).join(' ');
        });
        filters[filterType] = filters[filterType].filter(function (id) {
            return id !== filterId;
        });
    } else {
        // Add active class and corresponding background color
        filterObject.addClass('active');
        if (filterObject.hasClass('level-button')) {
            filterObject.addClass('bg-red-500 text-white');
        } else if (filterObject.hasClass('goal-button')) {
            filterObject.addClass('bg-blue-500 text-white');
        } else if (filterObject.hasClass('day-button')) {
            filterObject.removeClass('text-yellow-500');
            filterObject.addClass('bg-yellow-500 text-white');
        }

        filters[filterType].push(filterId);

        return filters;
    }
}

function renderWorkouts(workouts) {
    $('#workoutResults').empty(); // Clear previous results

    workouts.forEach(function (workout) {
        var workoutHtml = generateWorkoutHtml(workout);
        $('#workoutResults').append(workoutHtml);
    });

}

function generateWorkoutHtml(workout) {
    return `
<div class="workout my-3">
    <div class="workout-image rounded-t-xl">
        <img class="rounded-t-xl" src="https://static.vecteezy.com/system/resources/thumbnails/026/781/389/small_2x/gym-interior-background-of-dumbbells-on-rack-in-fitness-and-workout-room-photo.jpg" alt="" srcset="">
    </div>
    <div class="workout-content bg-white py-5 rounded-b-xl text-black">
        <div class="workout-title p-2 rounded-b-xl">${workout.name}</div>
        <div class="workout-level-goals-tags flex flex-row md:flex-col xl:flex-row gap-2 justify-between">
            ${generateGoalsTags(workout.goals)}
            ${generateLevelsTags(workout.levels)}
        </div>
        <div class="workout-duration-tags mt-2 flex flex-col justify-center align-middle items-start gap-2">
            ${generateDurationTag(workout.minutesPerWorkout, 'minutes per workout')}
            ${generateDurationTag(workout.workoutsPerWeek, 'days/week')}
            ${generateDurationTag(workout.lengthInWeeks, 'weeks')}
        </div>
    </div>
</div>`;
}

function generateGoalsTags(goals) {
    return `
    <div class="goal-tags text-xs flex gap-2 px-3">
        ${goals.map(goal => generateTag(goal, 'red')).join('')}
    </div>`;
}

function generateLevelsTags(levels) {
    return `
    <div class="level-tags text-xs flex gap-2 px-3">
        ${levels.map(level => generateTag(level, 'blue')).join('')}
    </div>`;
}

function generateDurationTag(value, label) {
    return `
    <div class="duration-tag text-xs px-3">
        <div class="tag bg-purple-200 text-purple-700 p-2 rounded-2xl">${value} ${label}</div>
    </div>`;
}

function generateTag(text, color) {
    return `<div class="tag bg-${color}-200 text-${color}-700 p-2 rounded-3xl">${text}</div>`;
}