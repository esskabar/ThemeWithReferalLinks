jQuery().ready(function($) {
    $(document).on('click', 'a.rate-btn', function(e) {
        e.preventDefault();

        if(!$('#overlay').length)
            $('body').prepend('<div id="overlay"></div>');
        else
            $('#overlay').show(1);

        if(!$('.popup').length)
            $('body').prepend('');
        else
            $('.popup').show(1);
    });

    $(document).on('click', 'a.close-popup', function(e) {
        e.preventDefault();
        $(this).closest('.popup').hide(1);
        $('#overlay').hide(1);
    });

    $('body').on('click', '#overlay', function(e) {
        e.preventDefault();
        console.log(111);
        $(this).hide(1);
        $('.popup').hide(1);
    });

    $('.bonuses-container, .software-container, .mobile-support-container, .customer-service-container, .slot-house-edge-container').rating();

    $(document).on('click', 'form.rate-form button', function(e) {
        e.preventDefault();
        var data = {
            action : 'rate_casino',
            bonus : $('input[type="radio"][name="bonuses"]:checked').val(),
            soft : $('input[type="radio"][name="software"]:checked').val(),
            mobile : $('input[type="radio"][name="mobile_support"]:checked').val(),
            customer : $('input[type="radio"][name="customer_service"]:checked').val(),
            slot : $('input[type="radio"][name="slot_house_edg"]:checked').val(),
            post_id : $('input[name="post_id"]').val()
        };

        $.post(ajaxurl, data, function() {
            window.location.reload();
        });

    })
});