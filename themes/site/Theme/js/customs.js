if (top.location != location) {
    top.location.href = document.location.href;
}
/*
 $(function(){
 window.prettyPrint && prettyPrint();
 $('.plans .nav-tabs:first').tabdrop();
 $('.plans .nav-tabs:last').tabdrop({text: 'More options'});
 $('.plans .nav-pills').tabdrop({text: 'With pills'});
 });
 */
/*		$(function(){
 window.prettyPrint && prettyPrint();
 $('.whmcs .nav-tabss:first').tabdrop();
 $('.whmcs .nav-tabss:last').tabdrop({text: 'More options'});
 $
 });
 */

jQuery(document).ready(function ($) {
    $('#tabs').tab();
});

function toggleDisplay(obj, id)
{
    var coun = 10;
    var coun2 = 10;
    obj.forEach(function (entry) {

        if ($(id).find(".host").find(entry).css("display") == 'none')
        {
            $(id).find(".host").find(entry).delay(coun).fadeToggle();
            coun = coun + 40;
        }
        if (coun == 50)
        {
            $(id).find(".host").find("#show_table .fa-plus").delay(coun).removeClass();
            $(id).find(".host").find("#more").delay(coun).addClass('fa fa-minus');
        }


    });

    if (coun == 10)
    {
        $(id).find(".host").find("#show_table .fa-minus").removeClass();
        $(id).find(".host").find("#more").addClass('fa fa-plus');
        var obj2 = obj.reverse();
        obj.forEach(function (entry)
        {
            $(id).find(".host").find(entry).delay(coun2).fadeToggle();
            coun2 = coun2 + 40;
        });

    }
}
/*		
 $(document).on("click", "#show_table", function() {
 var classname = $(this).closest('.tab-panes').attr('id');
 if(!classname){classname = $(this).closest('.tab-pane').attr('id');}
 var name = ['#email','#database','#domain','#ftp','#php','#panel','#place'];
 toggleDisplay(name,'#'+classname); 
 });
 
 
 var client1= new ZeroClipboard( document.getElementById("d_clip_button1"), {
 moviePath: "/ZeroClipboard.swf"
 } );
 
 client1.on( "load", function(client) {
 // alert( "movie is loaded" );
 
 client1.on( "complete", function(client, args) {
 // `this` is the element that was clicked
 
 alert("Copied text to clipboard: " + args.text );
 } );
 } );
 var client2= new ZeroClipboard( document.getElementById("d_clip_button2"), {
 moviePath: "/ZeroClipboard.swf"
 } );
 
 client2.on( "load", function(client) {
 // alert( "movie is loaded" );
 
 client2.on( "complete", function(client, args) {
 // `this` is the element that was clicked
 
 alert("Copied text to clipboard: " + args.text );
 } );
 } );
 
 var client3= new ZeroClipboard( document.getElementById("d_clip_button3"), {
 moviePath: "/ZeroClipboard.swf"
 } );
 
 client3.on( "load", function(client) {
 // alert( "movie is loaded" );
 
 client3.on( "complete", function(client, args) {
 // `this` is the element that was clicked
 
 alert("Copied text to clipboard: " + args.text );
 } );
 } );
 
 var client4= new ZeroClipboard( document.getElementById("d_clip_button4"), {
 moviePath: "/ZeroClipboard.swf"
 } );
 
 client4.on( "load", function(client) {
 // alert( "movie is loaded" );
 
 client4.on( "complete", function(client, args) {
 // `this` is the element that was clicked
 
 alert("Copied text to clipboard: " + args.text );
 } );
 } );
 
 var client5= new ZeroClipboard( document.getElementById("d_clip_button5"), {
 moviePath: "/ZeroClipboard.swf"
 } );
 
 client5.on( "load", function(client) {
 // alert( "movie is loaded" );
 
 client5.on( "complete", function(client, args) {
 // `this` is the element that was clicked
 
 alert("Copied text to clipboard: " + args.text );
 } );
 } );
 
 var client6= new ZeroClipboard( document.getElementById("d_clip_button6"), {
 moviePath: "/ZeroClipboard.swf"
 } );
 
 client6.on( "load", function(client) {
 // alert( "movie is loaded" );
 
 client6.on( "complete", function(client, args) {
 // `this` is the element that was clicked
 
 alert("Copied text to clipboard: " + args.text );
 } );
 } );
 
 
 var client7= new ZeroClipboard( document.getElementById("d_clip_button7"), {
 moviePath: "/ZeroClipboard.swf"
 } );
 
 client7.on( "load", function(client) {
 // alert( "movie is loaded" );
 
 client7.on( "complete", function(client, args) {
 // `this` is the element that was clicked
 
 alert("Copied text to clipboard: " + args.text );
 } );
 } );
 
 */
var check = false;
$(document).ready(function () {
    $("input").focus(function () {
        check = true;
    });
    $("input").blur(function () {
        check = false;
    });
    $("textarea").focus(function () {
        check = true;
    });
    $("textarea").blur(function () {
        check = false;
    });


    // $(".types").on( "keydown", function(event) {
    //  		 if(event.which==27 ){
    //    jQuery('.whois').removeClass('sticky2');
    // 		  jQuery('.whois').removeClass('sticky');};
    // if(check)return true;
    //      if(event.which >= 112  && event.which <= 123){
    //         return true;
    //  }
    //
    //  if(event.which==27 || event.which==192 ||event.which==9 ||event.which==20 ||event.which==16 ||event.which==17 ||event.which==91 ||event.which==18 ||event.which==32 ||event.which==93 ||event.which==37 ||event.which==38 ||event.which==39 ||event.which==40 ||event.which==13 ||event.which==144||event.which==111||event.which==106||event.which==109||event.which==107){return true;}
    //
    //  jQuery('.whois').addClass('sticky2');
    //  jQuery('.whois').addClass('sticky');
    //  $("#whoiser").focus();
    //  var keycode = (event.keyCode ? event.keyCode : event.which);
    //
    //  if(keycode=='8' )
    //  {
    // 	 if($("#whoiser").val().length<2)
    // 	 {
    // 		  jQuery('.whois').removeClass('sticky2');
    // 		  jQuery('.whois').removeClass('sticky');
    // 	 }
    //   }
    //   count = 0;
    // });
});
$('#whoiser2').click(function () {
    jQuery('.whois').removeClass('sticky2');
    jQuery('.whois').removeClass('sticky');
});


$(document).ready(function () {
    $('.carousel').carousel({
        interval: 3000,
        pause: false
    });
});

$('.planing a').click(function (e) {
    e.preventDefault();
    var id = $(this).closest('.planing a').attr('href');
    $('html, body').animate({
        scrollTop: $(id).offset().top
    }, 1000);
})


/*
 jQuery("#layerslider").layerSlider({
 responsive: false,
 responsiveUnder: 1280,
 layersContainer: 1280,
 skin: 'noskin',
 hoverPrevNext: false,
 skinsPath: '../layerslider/skins/'
 });
 jQuery("#layerslider2").layerSlider({
 responsive: false,
 responsiveUnder: 1280,
 layersContainer: 1280,
 skin: 'noskin',
 hoverPrevNext: false,
 skinsPath: '../layerslider/skins/'
 });
 */
function toggleCheckboxes(classname) {
//    jQuery("."+classname).attr('checked',!jQuery("."+classname+":first").is(':checked'));
    if (jQuery("." + classname).prop("checked") == false)
    {
        jQuery("." + classname).attr("CHECKED", true);
    } else
    {
        jQuery("." + classname).attr("CHECKED", false);
    }

}





/*
 * Start By Mehdi moshirifar 
 *
 */




$(document).ready(function ($) {
    $(".tic-btn").click(function () {
        $(".tic-box02").stop().animate({top: "19px"}, 500).delay('500').animate({top: "37px"}, 500).delay('500').animate({top: "57px"}, 500);

    });
    $('.modal').on('hidden.bs.modal', function () {
        // do something…
        var player = document.getElementById('example_video_1');
        player.player.pause();
    })
    $(".modal").on('shown.bs.modal', function (event) {
        var height = $('#example_video_1').height();
        $('.modal-dialog').css({
            'margin-top': -(height / 2),
            'top': '50%',
        });
    });
});




$(window).scroll(function () {
    $('#reg01-p02').each(function () {
        var imagePos1 = $('#reg01-p02').offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos1 < topOfWindow + 200) {
            $('#reg01-p02').find('.reg01-p02 img').addClass("reg01-p02-block");
        }
    });
    $('#reg01-p02').each(function () {
        var imagePos1 = $('#reg01-p02').offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos1 < topOfWindow + 100) {
            $('#reg01-p02').find('.reg02-p01 img').addClass("reg01-p02-block");
        }
    });
    $('#reg01-p02').each(function () {
        var imagePos1 = $('#reg01-p02').offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos1 < topOfWindow + 50) {
            $('#reg01-p02').find('.reg02-p02').addClass("reg01-p02-block");
        }
    });
    $('#reg01-p02').each(function () {
        var imagePos1 = $('#reg01-p02').offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos1 < topOfWindow + 1) {
            $('#reg01-p02').find('.reg03-p01 img').addClass("reg01-p02-block");
        }
    });
    $('#reg01-p02').each(function () {
        var imagePos1 = $('#reg01-p02').offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos1 < topOfWindow - 500) {
            $('#reg01-p02').find('.reg03-p02 img').addClass("reg01-p02-block");
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p04 img').addClass("reg03-p02-block ");
            }, 150);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p05 img').addClass("reg03-p02-block ");
            }, 300);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p06 img').addClass("reg03-p02-block ");
            }, 450);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p07 img').addClass("reg03-p02-block ");
            }, 600);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p08 img').addClass("reg03-p02-block ");
            }, 750);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p09 img').addClass("reg03-p02-block ");
            }, 900);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p10 img').addClass("reg03-p02-block ");
            }, 1050);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p11 img').addClass("reg03-p02-block ");
            }, 1200);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p12 img').addClass("reg03-p02-block ");
            }, 1350);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p13 img').addClass("reg03-p02-block ");
            }, 1500);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p14 img').addClass("reg03-p02-block ");
            }, 1650);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p15 img').addClass("reg03-p02-block ");
            }, 1800);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p16 img').addClass("reg01-p02-block ");
            }, 2000);
            setTimeout(function () {
                $('#reg01-p02').find('.reg03-p17 img').addClass("reg01-p02-block ");
            }, 2300);
        }
    });
});

/*
 * cod for change number en to persian
 */
/*
 function travers(){
 
 jQuery(document).ready(function() {
 jQuery("body *").not( "#twofaactivation *" ).not( "style" ).each(function(k, v) {
 if(v.className != "counter" && v.className != "bank"  && v.className !="noper"){
 jQuery(v).andSelf().contents().each(function() {
 if (this.nodeType === 3)
 {
 this.nodeValue = this.nodeValue.replace(/\d/g, function(v) {
 return String.fromCharCode(v.charCodeAt(0) + 0x0630);
 });
 }
 });
 }
 });
 });
 }
 /*
 * end cod mehdi moshirifar 
 */


$(document).ready(function () {

    //Check to see if the window is top if not then display button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

});