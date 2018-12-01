var url = 'http://localhost/Laragram/public/';

// Likes
function like(){
    $('.btn-like').unbind('click').click(function(){
        // change of color
        $(this).removeClass('btn-like').addClass('btn-dislike');
        $(this).attr('src', url+'img/heart-red.png');

        // Ajax request
        $.ajax({
            url: url+'new-like/'+$(this).attr('data-id'), 
            type: 'GET', 
            success: function(response){
                if(response.like){
                    console.log('like');
                    location.reload(); 
                }
            }
        });
    });
}

// Dislikes
function dislike(){
    $('.btn-dislike').unbind('click').click(function(){
        // change of color
        $(this).removeClass('btn-dislike').addClass('btn-like');
        $(this).attr('src', url+'img/heart-black.png');

        // Ajax request
        $.ajax({
            url: url+'dislike/'+$(this).attr('data-id'),
            type: 'GET',
            success: function(response){
                if(response.like){
                    console.log('dislike');
                    location.reload();
                }
            }
        });
    });
}

$(document).ready(function(){
    like();    
    dislike();
    search();
});