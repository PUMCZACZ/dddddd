var current_movie = 0, movies = [];

function saveMovie() {
    var value = $('input[name=movie]').val();
    movies[current_movie] = value;
    if ($('.movie_' + current_movie).length === 0) {
        $('.movies').append('<input type="hidden" name="movies[]" class="movie_' + current_movie + '" value="' + current_movie + '"/>');
        $('.movies').append('<input type="hidden" name="movie[' + current_movie + ']" id="movie_input_' + current_movie + '" class="movie_' + current_movie + '" value="' + value + '"/>');
        $('.movies').append('\n' +
            '<div class="d-flex movie_' + current_movie + '">\n' +
            '    <span id="movie_' + current_movie + '"></span>\n' +
            '    <span class="ml-2" onclick="removeMovies(' + current_movie + ')"><em class="fa fa-trash text-danger"></em></span>\n' +
            '</div>');
    }
    $('#movie_input_' + current_movie).val(value);
    $('#movie_' + current_movie).html(value);
}

function removeMovies(id) {
    $('.movie_' + id).remove();
    movies.splice(id, 1);
    if (current_movie === id) {
        setCurrentMovies(0);
    }
}

function setCurrentMovies(id) {
    $('input[name=movie]').val(movies.length - 1 >= id ? movies[id] : '');
    current_movie = id;
}
$(function () {
    $('#next_movie').click(function () {
        saveMovie();
        setCurrentMovies(current_movie + 1);
    });
});
