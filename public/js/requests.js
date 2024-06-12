$(document).ready(function () {
    $('.fade-in').addClass('show');

    $('.openModal').click(function () {
        $('#myModal').fadeIn();
    });

    $('#closeModal').click(function () {
        $('#myModal').fadeOut();
    });

    $('#closeModalButton').click(function () {
        $('#myModal').fadeOut();
    });

    $(window).click(function (event) {
        if (event.target === $('#myModal')[0]) {
            $('#myModal').fadeOut();
        }
    });
});


$(document).ready(function () {
    $('.openModal').click(function (event) {
        var id = $(this).attr('id');

        event.preventDefault();

        const url = 'http://127.0.0.1:8000/api/compounds/' + id;

        $.get(url)
            .done(response => {
                processData(response.data);
            })
            .fail((xhr, status, error) => {
                console.error(error);
            });
    });
});

function processData(data) {
    $('#name').text(data.name);
    $('#description').text(data.name);
    $('#shortDescription').text(data.shortDescription);

    // Clear previous content
    $('#muscles').empty();

    // Iterate over muscles array and create span elements
    data.muscles.forEach(function (muscle, index) {
        var span = $('<span>', {
            'class': 'bg-red-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900',
            'text': muscle
        });

        // Append the span to the container
        $('#muscles').append(span);

        if ((index + 1) % 1 === 0) {
            // Append a new row div after every 3 spans
            $('#muscles').append('<div class="row"></div>');
        }
    });

    $('#image').attr('src', data.imagePath);
    $('#compound_id').val(data.id);
}
