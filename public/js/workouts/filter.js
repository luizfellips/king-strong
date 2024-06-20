$(document).ready(function() {
    $('#toggleFilter').click(function() {
        toggleFilter($(this).hasClass('active'));
    });
});

function toggleFilter(state) {
    const toggleFilterElement = $('#toggleFilter');
    const filterOptionsElement = $('#filterOptions');

    if (state) {
        toggleFilterElement.removeClass('active');
        filterOptionsElement.addClass('hidden').removeClass('flex ');
    } else {
        toggleFilterElement.addClass('active');
        filterOptionsElement.addClass('flex').removeClass('hidden');
    }
}
