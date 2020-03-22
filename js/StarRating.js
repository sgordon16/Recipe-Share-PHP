$(document).ready(function(){
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');
    var ratings = $('.rating');
    for (var i = 0; i < ratings.length; i++) {
        var r = new SimpleStarRating(ratings[i]);

        $(ratings[i]).on('rate', function(e) {
            var rating = e.detail;
            $.ajax({
                type: 'POST',
                url: 'rate.php',
                data: { rating: rating, id: id }, 
                success: function(response) {
                    //alert(response);
                }
            });
        });
    }

    var save = $('#save');

    $(save).on('click', function(e) {
        //var rating = e.detail;
        $.ajax({
            type: 'POST',
            url: 'save.php',
            data: { id: id }, 
            success: function(response) {
                alert(response);
            }
        });
    });
});
