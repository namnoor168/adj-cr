jQuery(document).ready(function($) {
    $(document).on('click', '.size_guide', function(e) {
        $(this).parent().stop().toggleClass('active')
    });
});
