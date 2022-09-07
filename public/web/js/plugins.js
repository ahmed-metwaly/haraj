$(document).ready(function() { "use strict";
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) { $('.scroll-top').fadeIn(); } else { $('.scroll-top').fadeOut(); } });
    $('.scroll-top').click(function() { $("html, body").animate({ scrollTop: 0 }, 600);
        return false; });

    function change() { document.getElementById("myButton1").value = "تم الإرسال لجوالك المسجل وهو:+966556066597"; }
    $(window).scroll(function() {
        if ($(window).scrollTop() > 100) { $('.header-top').addClass('header-fixed-top'); }
        if ($(window).scrollTop() < 100) { $('.header-top').removeClass('header-fixed-top'); } });
    $(function() { $(document).on('click', '.btn-add', function(e) { e.preventDefault();
            var controlForm = $('.controls:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add').removeClass('btn-add').addClass('btn-remove').removeClass('btn-success').addClass('btn-danger').html('<span class="glyphicon glyphicon-minus"></span>'); }).on('click', '.btn-remove', function(e) { $(this).parents('.entry:first').remove();
            e.preventDefault();
            return false; }); });
    new WOW().init();
    $(".links-tags a").click(function() { $(".links-tags.second").fadeIn(); });
    $(".links-tags.second a").click(function() { $(".links-tags.third").fadeIn(); });
    if (window.addEventListener) window.addEventListener('DOMMouseScroll', wheel, false);
    window.onmousewheel = document.onmousewheel = wheel;

    function wheel(event) {
        var delta = 0;
        if (event.wheelDelta) delta = event.wheelDelta / 120;
        else if (event.detail) delta = -event.detail / 3;
        handle(delta);
        if (event.preventDefault) event.preventDefault();
        event.returnValue = false; }
    var goUp = true;
    var end = null;
    var interval = null;

    function handle(delta) {
        var animationInterval = 20;
        var scrollSpeed = 20;
        if (end == null) { end = $(window).scrollTop(); }
        end -= 20 * delta;
        goUp = delta > 0;
        if (interval == null) { interval = setInterval(function() {
                var scrollTop = $(window).scrollTop();
                var step = Math.round((end - scrollTop) / scrollSpeed);
                if (scrollTop <= 0 || scrollTop >= $(window).prop("scrollHeight") - $(window).height() || goUp && step > -1 || !goUp && step < 1) { clearInterval(interval);
                    interval = null;
                    end = null; }
                $(window).scrollTop(scrollTop + step); }, animationInterval); } }; });
$(window).on('load', function() { $(".regot-loader").fadeOut(1500, function() { $(this).parent().fadeOut(500);
        $("body").css("overflow", "auto") }); });
if ($(".over-lay").length) { $("body").css("overflow", "hidden") } else { $("body").css("overflow", "auto") };




function getAjaxData(selectorChange, selectorHtml, url, col) {

//console.log(url);
    $(selectorChange).change(function(){
console.log('hello');
        $(selectorHtml).html('<option> جارى التحميل ...</option>');

        var id = $(this).val();
        console.log('id',id);
        var url1 = url + '/' + id + '/' + col ;
        console.log(url1);
/*
        $.ajax({
          type: 'POST',
          url: url,
          data: postedData,
          dataType: 'json',
          success: callback
        });
*/
        
        $.ajax({
            method : 'GET',
            url : url + '/' + id + '/' + col  ,
            cache : false ,

        }).success(function(data) {
            console.log(data);
            $(selectorHtml).html('');
            var json = JSON.parse(data);

            console.log(data);

            $.each(json, function(key, val) {
                $(selectorHtml).removeAttr('disabled');
                $(selectorHtml).append('<option value="' + val.id + '">' + val.name + '</option>');

            });



        }).error(function(data) {

            console.log(data);

        });

    });


}

