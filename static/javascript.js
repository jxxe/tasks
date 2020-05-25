$(document).ready(function(){
    $(document).scroll(function(){
        if($(document).scrollTop() == 0) {
            $('#header').css('box-shadow', 'none');
        } else {
            $('#header').css('box-shadow', '0px 0px 5px 0px rgba(0,0,0,0.25)');
        }
    })

    $('.avatar').click(function(){
        $('#account-menu').toggle();
    })
})