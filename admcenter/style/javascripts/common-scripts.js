function moneyCommaSep(ctrl){
	var separator = ",";
	var int = ctrl.value.replace ( new RegExp ( separator, "g" ), "" );
	var regexp = new RegExp ( "\\B(\\d{3})(" + separator + "|$)" );
	do{int = int.replace ( regexp, separator + "$1" );
	}while( int.search ( regexp ) >= 0 )
	ctrl.value = int;
}

function removeComma(ctrl){
	var separator = ",";
	ctrl.value = ctrl.value.replace ( new RegExp ( separator, "g" ), "" );
	
	return false;
	
}

function conf_delete(step1) {
	
	step1 = typeof step1 !== 'undefined' ? step1 : 1;
	
	var conf=confirm('This action is irreversible and the data will be deleted without any backup , Are you sure?');
	
	
	if(conf){
		if(step1==2){
			var conf2=confirm('Your data are about to be deleted completly , Are you sure? ');
			if(conf2)
				return true;
			else
				return false;
			
			
		}else
			return true;
	}else
		return false;
		
		
		
}



var Script = function () {



//    sidebar dropdown menu

    jQuery('#sidebar .sub-menu > a').click(function () {
        var last = jQuery('.sub-menu.open', $('#sidebar'));
        last.removeClass("open");
        jQuery('.arrow', last).removeClass("open");
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.arrow', jQuery(this)).removeClass("open");
            jQuery(this).parent().removeClass("open");
            sub.slideUp(200);
        } else {
            jQuery('.arrow', jQuery(this)).addClass("open");
            jQuery(this).parent().addClass("open");
            sub.slideDown(200);
        }
        var o = ($(this).offset());
        diff = 200 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });

//    sidebar toggle


    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('.icon-reorder').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-150px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '150px'
            });
			
			
			
			
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar


    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '10', cursorborderradius: '10px', background: '#404040', cursorborder: '', zindex: '1000'});






    $('.tooltips').tooltip();







}();