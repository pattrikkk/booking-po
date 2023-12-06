$('.btn-number').click(function (e) {
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == 'minus') {

            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if (type == 'plus') {

            if (currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function () {
    $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function () {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});

var map = '';
var center;

function initialize() {
    var mapOptions = {
        zoom: 13,
        center: new google.maps.LatLng(-23.013104,-43.394365),
        scrollwheel: false
    };

    map = new google.maps.Map(document.getElementById('google-map'),  mapOptions);

    google.maps.event.addDomListener(map, 'idle', function() {
      calculateCenter();
  });

    google.maps.event.addDomListener(window, 'resize', function() {
      map.setCenter(center);
  });
}

function calculateCenter() {
    center = map.getCenter();
}

function loadGoogleMap(){

} 

function setCarousel() {
    
    if ($('.tm-article-carousel').hasClass('slick-initialized')) {
        $('.tm-article-carousel').slick('destroy');
    } 

    if($(window).width() < 438){
        // Slick carousel
        $('.tm-article-carousel').slick({
            infinite: false,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    }
    else {
     $('.tm-article-carousel').slick({
            infinite: false,
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 1
        });   
    }
}

function setPageNav(){
    if($(window).width() > 991) {
        $('#tm-top-bar').singlePageNav({
            currentClass:'active',
            offset: 79
        });   
    }
    else {
        $('#tm-top-bar').singlePageNav({
            currentClass:'active',
            offset: 65
        });   
    }
}

function togglePlayPause() {
    vid = $('.tmVideo').get(0);

    if(vid.paused) {
        vid.play();
        $('.tm-btn-play').hide();
        $('.tm-btn-pause').show();
    }
    else {
        vid.pause();
        $('.tm-btn-play').show();
        $('.tm-btn-pause').hide();   
    }  
}

$(document).ready(function(){     

    // Google Map
    loadGoogleMap();  

    // Date Picker
    const pickerCheckIn = datepicker('#inputCheckIn');
    const pickerCheckOut = datepicker('#inputCheckOut');
    
    // Slick carousel
    setCarousel();
    setPageNav();


    // Close navbar after clicked
    $('.nav-link').click(function(){
        $('#mainNav').removeClass('show');
    });

    // Control video
    $('.tm-btn-play').click(function() {
        togglePlayPause();                                      
    });

    $('.tm-btn-pause').click(function() {
        togglePlayPause();                                      
    });

    // Update the current year in copyright
    $('.tm-current-year').text(new Date().getFullYear());                           
});