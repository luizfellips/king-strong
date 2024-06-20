$(document).ready(function () {
    $('.fade-in').addClass('show');

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
