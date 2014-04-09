jQuery.fn.gallSlide = function(_options){
	// defaults options
	var _options = jQuery.extend({
	    duration: 700,
	    autoSlide: 5000,
	    noWrap: true,
	    hackAdd: 1,
	    active: -1
	},_options);

	return this.each(function(){
		var _hold = $(this);
		var _speed = _options.duration;
		var _timer = _options.autoSlide;
		var _noWrap = _options.noWrap;
		var _wrap = _hold.find('ul.slider-list');
		var _el =_wrap.children('li');
		var _next = _hold.find('a.link-next');
		var _prev = _hold.find('a.link-prev');
		var _count = _el.index(_el.filter(':last'));
		var _w = _el.outerWidth();
		var _hackAdd = _options.hackAdd;
		var _wrapHolderW = 0;
		if(_w) _wrapHolderW = Math.ceil(_wrap.parent().width()/_w);
		var _t;
		var _active = _options.active;
		runTimer();
	    function reInit() {
                if(!_w) {
	            _w = _el.outerWidth();
	            if(_w > 0) _wrapHolderW = Math.ceil(_wrap.parent().width()/_w);
		}
	    }
	    function scrollEl(){
		_wrap.eq(0).animate({
		    marginLeft: -(_w * _active) + "px"
		}, {queue:false, duration: _speed});
	    }

	    function runTimer(){
		if(_timer) {
		    _t = setInterval(function(){
			if (_active > (_count - _wrapHolderW + _hackAdd)) {
				    if(!_noWrap) {
					    _active = 0;
				    }
				}
				else {
				    _active++;
				}
			scrollEl();
		    }, _timer);
		}
		else {
		    _active++;
		    if (_active > (_count - _wrapHolderW + _hackAdd)) {
			    _active = 0;
		    }
		    scrollEl();
		}
	    }
		
	    _next.click(function(){
		reInit();
		if(_t) {
		    clearTimeout(_t);
		}
		if (_active > (_count - _wrapHolderW + _hackAdd)) {
		    if(!_noWrap) {
                   	_active = 0;
	            }
	        }
                else {
	            _active++;
	        }
		scrollEl();
		return false;
	    });
	
	    _prev.click(function(){
		reInit();
		if(_t) clearTimeout(_t);
		if (_active <= 0) {
		    if(!_noWrap) {
                	_active = _count - _wrapHolderW + _hackAdd;
		    }
		}
		else {
                    _active--;
	        }
		scrollEl();
		return false;
	    });
	});
}

jQuery.fn.bottomSlide = function(_options){
	// defaults options
	var _options = jQuery.extend({
		duration: 1000,
		autoSlide: false,
		slideElement: 4,
		effect: false,
		fadeEl: 'ul',
		switcher: 'ul > li',
		disableBtn: false,
		next: 'a.link-next, a.btn-next, a.next',
		prev: 'a.link-prev, a.btn-prev, a.prev',
		circle: true,
		direction: false,
		pause: false,
		play: 'play'
	},_options);

	return this.each(function(){
		var _hold = $(this);
		if (!_options.effect) var _speed = _options.duration;
		else var _speed = $.browser.msie ? 0 : _options.duration;
		var _timer = _options.autoSlide;
		var _timeHold = _timer;
		var _sliderEl = _options.slideElement;
		var _wrap = _hold.find(_options.fadeEl);
		var _el = _hold.find(_options.switcher);
		var _next = _hold.find(_options.next);
		var _prev = _hold.find(_options.prev);
		var _paused = _hold.find(_options.pause);
		var _count = _el.index(_el.filter(':last'));
		var _w = _el.outerWidth(true);
		var _h = _el.outerHeight(true);
		if (!_options.direction) {
			var _wrapHolderW = Math.ceil(_wrap.parent().width() / _w);
			if (((_wrapHolderW - 1) * _w + _w / 2) > _wrap.parent().width()) _wrapHolderW--;
		}
		else{
			var _wrapHolderW = Math.ceil(_wrap.parent().height()/_h);
			if (((_wrapHolderW-1)*_h + _h/2) > _wrap.parent().height()) _wrapHolderW--;
		}
		if (_timer) var _t;
		var _active = _el.index(_el.filter('.active:eq(0)'));
		if (_active < 0) _active = 0;
		var _last = _active;
		if (!_options.effect) var rew = _count - _wrapHolderW + 1;
		else var rew = _count;

		if (!_options.effect) {
			if (!_options.direction) _wrap.css({marginLeft: -(_w * _active)})
			else _wrap.css({marginTop: -(_h * _active)})
		}
		else {
			_wrap.css({
				opacity: 0
			}).removeClass('active').eq(_active).addClass('active').css({
				opacity: 1
			}).css('opacity', 'auto');
			_el.removeClass('active').eq(_active).addClass('active');
		}
		if (_options.disableBtn) {
			if (_count < _wrapHolderW) _next.addClass(_options.disableBtn);
			_prev.addClass(_options.disableBtn);
		}

		function fadeElement(){
			_wrap.eq(_last).animate({opacity:0}, {queue:false, duration: _speed});
			_wrap.removeClass('active').eq(_active).addClass('active').animate({
				opacity:1
			}, {queue:false, duration: _speed, complete: function(){
				$(this).css('opacity','auto');
			}});
			_el.removeClass('active').eq(_active).addClass('active');
			_last = _active;
		}
		function scrollEl(){
			if (!_options.direction) _wrap.animate({marginLeft: -(_w * _active)}, {queue:false, duration: _speed})
			else _wrap.animate({marginTop: -(_h * _active)}, {queue:false, duration: _speed})
		}
		function toPrepare(){
			if ((_active == rew) && _options.circle) _active = -_sliderEl;
			for (var i = 0; i < _sliderEl; i++){
				_active++;
				if (_active > rew) {
					_active--;
					if (_options.disableBtn &&(_count > _wrapHolderW)) _next.addClass(_options.disableBtn);
				}
			};
			if (_active == rew) if (_options.disableBtn &&(_count > _wrapHolderW)) _next.addClass(_options.disableBtn);
			if (!_options.effect) scrollEl();
			else fadeElement();
		}
		function runTimer(){
			_t = setInterval(function(){
				toPrepare();
			}, _timer);
		}
		_next.click(function(){
			if(_t) clearTimeout(_t);
			if (_options.disableBtn &&(_count > _wrapHolderW)) _prev.removeClass(_options.disableBtn);
			toPrepare();
			if (_timer) runTimer();
			return false;
		});
		_prev.click(function(){
			if(_t) clearTimeout(_t);
			if (_options.disableBtn &&(_count > _wrapHolderW)) _next.removeClass(_options.disableBtn);
			if ((_active == 0) && _options.circle) _active = rew + _sliderEl;
			for (var i = 0; i < _sliderEl; i++){
				_active--;
				if (_active < 0) {
					_active++;
					if (_options.disableBtn &&(_count > _wrapHolderW)) _prev.addClass(_options.disableBtn);
				}
			};
			if (_active == 0) if (_options.disableBtn &&(_count > _wrapHolderW)) _prev.addClass(_options.disableBtn);
			if (!_options.effect) scrollEl();
			else fadeElement();
			if (_timer) runTimer();
			return false;
		});
		if (_options.effect) _el.click(function(){
			_active = _el.index($(this));
			if(_t) clearTimeout(_t);
			fadeElement();
			if (_timer) runTimer();
			return false;
		});
		if (_timer) runTimer();
		if (_options.pause) _paused.click(function(){
			if ($(this).hasClass(_options.play)){
				$(this).removeClass(_options.play);
				_timer = _timeHold;
				runTimer();
			}
			else{
				$(this).addClass(_options.play);
				_timer = false;
				if(_t) clearTimeout(_t);
			}
			return false;
		});
	});
}

function initTabs() {

    var objTabs = $('#tabset-auto');

    if(objTabs.length == 0) return;

	objTabs.each(function(){
		var _list = $(this);
		var _links = _list.find('a.tab');

		_links.each(function() {
			var _closer = $(this).parent('li').find('a.close');
			var _link = $(this);
			var _href = _link.attr('href');
			var _tab = $(_href);

			if(_link.parent('li').hasClass('active')) _tab.show();
			else _tab.hide();

			_link.click(function(){
				_links.parent('li').filter('.active').each(function(){
					$(this).removeClass('active');
					$($(this).find('a').attr('href')).hide();
				});
				_link.parent('li').addClass('active');
				_tab.show();
				return false;
			});
			_closer.click(function(){
				$(this).parents('li').remove();
				_tab.hide();
				return false;
			});

		});
	});
}
function listAddClass(){
	var _list = $('ul.categories-list > li');
	var _N = _list.length;
	for (var _i=_N-8; _i<_N; _i++) {
		_list.eq(_i).addClass('specular-popup');
};
}
function fadeGall(){
	var wait_time = 5000; // in ms
	var change_speed = 1200; // in ms
	var _hold = $('div.fuse-gallery');
	if(_hold.length){
		var _t;
		var _k;
		var _f = true;
		var _list = _hold.find('ul.fuse-list > li');
		var _btn = $('<ul class="paging"></ul>');
		_list.each(function(_i){
			_btn.append('<li><a href="#">'+(_i+1)+'</a></li>');
		});
		_btn = _btn.find('a');
		var _a = _list.index(_list.filter('.active:eq(0)'));
		if(_a == -1) _a = 0;

		_list.removeClass('active').css('opacity', 0).eq(_a).addClass('active').css('opacity', 1);
		_btn.eq(_a).parent('li').addClass('active');
		_btn.click(function(){
			changeEl(_btn.index(this));
			return false;
		});

		var _next = _hold.find('a.link-next');
		var _prev = _hold.find('a.link-prev');

		_next.click(function(){
			if(_a < _list.length-1){
				_k = _a+1;
			}
			else{
				_k = 0;
			}
			changeEl(_k);
			return false;
		});

		_prev.click(function(){
			if(_a > 0){
				_k = _a-1;
			}
			else{
				_k = _list.length-1;
			}
			changeEl(_k);
			return false;
		});

		_hold.mouseenter(function(){
			_f = false;
			if(_t) clearTimeout(_t);
		}).mouseleave(function(){
			_f = true;
			if(_t) clearTimeout(_t);
			if(_f && wait_time){
				_t = setTimeout(function(){
					if(_a < _list.length - 1) changeEl(_a + 1);
					else changeEl(0);
				}, wait_time);
			}
		});
		if(_f && wait_time){
			_t = setTimeout(function(){
				if(_a < _list.length - 1) changeEl(_a + 1);
				else changeEl(0);
			}, wait_time);
		}
		function changeEl(_ind){
			if(_t) clearTimeout(_t);
			if(_ind != _a){
				_list.eq(_a).removeClass('active').animate({opacity: 0}, {queue:false, duration:change_speed});
				_list.eq(_ind).addClass('active').animate({opacity: 1}, {queue:false, duration:change_speed});
				_btn.eq(_a).parent('li').removeClass('active');
				_btn.eq(_ind).parent('li').addClass('active');
				_a = _ind;
			}
			if(_f && wait_time){
				_t = setTimeout(function(){
					if(_a < _list.length - 1) changeEl(_a + 1);
					else changeEl(0);
				}, wait_time);
			}
		}
	}
}

$(document).ready(function(){

	$('#ending-soon-slider').gallSlide({
		duration: 1000,
		autoSlide: false,
        noWrap: true
	});
	$('#watch-slider').gallSlide({
		duration: 300,
		autoSlide: false,
        noWrap: true
	});
	$('#banner-rotator-ads').gallSlide({
		duration: 500,
		autoSlide: 8000,
        noWrap: false,
        hackAdd: 0
	});
    /*
	$('div.ended-gallery').bottomSlide({
		duration: 1000,
		autoSlide: false,
        noWrap: true
	});
    */
	initTabs();
	listAddClass();
	fadeGall();
});