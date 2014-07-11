/**
 * Hide Header on scroll down based on the scrolling speed
 * Show Header when scrolling back up
**/
/*
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {

    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){

        // Scroll Down
        $('.header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('.header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}
*/
/**
 * Swipe gestures
 * Open the nav bar when swiping left
**/
 $( document ).on( "swipeleft swiperight", function( e ) {
    if($('.top-bar .toggle-topbar ').css('display')!='none'){
        if ( e.type === "swipeleft"  ) {
            $('.off-canvas-wrap').removeClass('move-right');
        } else if ( e.type === "swiperight" ) {
            $('.off-canvas-wrap').addClass('move-right');
        }
    }
});

/**
 * Manage forms with AJAX
 *
**/
/*
$(document).ready(function() {
    $('.ajax').submit(function(event){
        $form = $(this);
        $url = $form.attr('action');
        event.preventDefault();
        var dataobj = $(this).serializeArray();
        dataobj.push({name : 'kind', value:'ajax' });
        console.log(dataobj);
        $.ajax({
            type: 'POST',
            url: $url,
            data: dataobj,
            dataType: 'json',
        })
        .done(function(data) {
            //console.log(data); 
            // take care of that AJAX response
             manageAjaxResponse(data);
        });
        //just to be sure its not submiting form
        return false;
    });
});

function manageAjaxResponse(data){
    $.each(data, function(name, value) {
        
        var defaultcontainer = '.alert__container';

        if( name == 'alert' || 
            name == 'message' || 
            name == 'success') {
            if(typeof value ==  'object'){
                //if(name=='alert'){
                  //  createAlertDialog(name, 'There were some errors', defaultcontainer);
                //}
                $.each(value, function(tipo,mensaje){
                    createAlertDialog(name, mensaje, '.'+tipo+'-field',' ', 'prepend');
                })
            }else{
                createAlertDialog(name, value, defaultcontainer);
            }


            
        }
    });
}*/
/**
 * alerttype    [ alert | message | success ]
 * message      [ string]
 * destination  [ selector CSS]
 * params       [ string]
 * location     [ html | prepend | append ]
 **/
 /*
function createAlertDialog(alerttype, message, destination, params, location){
    params = (typeof params === "undefined") ? "large-6 small-centered columns" : params;
    location = (typeof location === "undefined") ? 'html' : location;
        var alerta = '<div data-alert class="'
                    + alerttype + ' ' +params
                    + ' alert-box ">'
                    + message + '<a href="#" class="close">&times;</a></div>';
    
    switch(location){
        case 'html': 
            $(destination).html(alerta);
            break;
        case 'prepend': 
            $(destination).prepend(alerta);
            break;
        case 'append': 
            $(destination).append(alerta);
            break;
    }

    
     $('.alert-box > a.close').click(function() { $(this).closest('[data-alert]').fadeOut(); });
}*/