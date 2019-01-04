var currentCol = 1;
var menuTimeout;
$(document).ready(function(){
	$('#menubutton').click(function(){
		$('#menu').toggleClass('open');
		if($('#menu').hasClass('open')) {
			$('#menu').show();
			clearTimeout(menuTimeout);
		}
		else {
			menuTimeout = setTimeout(function(){
				$('#menu').hide();
			},400)
		}
		return false;
	});
	$('#page').click(function(){
		$('#menu').removeClass('open');
		menuTimeout = setTimeout(function(){
			$('#menu').hide();
		},400)
	});
	$('.column-swiper .next').click(function(){
		if(currentCol < 3) $(this).closest('.column-swiper').css('left', (++currentCol * -100)  + "%");
		return false;
	});
	$('.column-swiper .prev').click(function(){
		if(currentCol > 0) $(this).closest('.column-swiper').css('left', (--currentCol * -100)  + "%");
		return false;
	});
	var columnswiper = document.getElementsByClassName('column-swiper')[0];
	var mc = new Hammer(columnswiper);
	mc.get('swipe').set({
		velocity: 0.3
	});

	mc.on("swiperight", function(ev) {
		if(currentCol > 0) $('.column-swiper').css('left', (--currentCol * -100)  + "%");
		return false;
	});
	mc.on("swipeleft", function(ev) {
		if(currentCol < 3) $('.column-swiper').css('left', (++currentCol * -100)  + "%");
		return false;
	});
});

function showhelp(){ $("#helpbox").fadeIn();}
function hidehelp(){ $("#helpbox").fadeOut();}