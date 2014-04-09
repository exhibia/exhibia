/*
 * jQuery jSlots Plugin
 * http://matthewlein.com/jslot/
 * Copyright (c) 2011 Matthew Lein
 * Version: 1.0.2 (7/26/2012)
 * Dual licensed under the MIT and GPL licenses
 * Requires: jQuery v1.4.1 or later
 */

(function($){

    $.jSlots = function(el, options){

        var base = this;

        base.$el = $(el);
        base.el = el;

        base.$el.data("jSlots", base);

        base.init = function() {

            base.options = $.extend({},$.jSlots.defaultOptions, options);

            base.setup();
            base.bindEvents();

        };


        // --------------------------------------------------------------------- //
        // DEFAULT OPTIONS
        // --------------------------------------------------------------------- //

        $.jSlots.defaultOptions = {
	    alert_area: '#slot_alert',
	    bid_area: 'bids_count',
	    bid_area_two: 'bids_count_two',
	    bid_area_three: 'bids_count_three',
            final_bids: document.getElementById('bids_count').innerHTML,
            number : 3,          // Number: number of slots
            winnerNumber : 1,    // Number or Array: list item number(s) upon which to trigger a win, 1-based index, NOT ZERO-BASED
            spinner : '',        // CSS Selector: element to bind the start event to
            spinEvent : 'click', // String: event to start slots on this event
            onStart : $.noop,    // Function: runs on spin start,
            onEnd : $.noop,      // Function: run on spin end. It is passed (finalNumbers:Array). finalNumbers gives the index of the li each slot stopped on in order.
            onWin : $.noop,      // Function: run on winning number. It is passed (winCount:Number, winners:Array)
            onLose : $.noop,
	    easing : 'swing',    // String: easing type for final spin
            time : 7000,         // Number: total time of spin animation
            loops : 6,            // Number: times it will spin during the animation
            ajax_url : '',
	    bids_placed: '#bids_placed',
	    no_bids_message: 'Please place a bid'
	    
        };

        // --------------------------------------------------------------------- //
        // HELPERS
        // --------------------------------------------------------------------- //

        base.randomRange = function(low, high) {
            return Math.floor( Math.random() * (1 + high - low) ) + low;
        };

        // --------------------------------------------------------------------- //
        // VARS
        // --------------------------------------------------------------------- //
	
        base.isSpinning = false;
        base.spinSpeed = 0;
        base.winCount = 0;
        base.doneCount = 0;

        base.$liHeight = 0;
        base.$liWidth = 0;

        base.winners = [];
        base.allSlots = [];

        // --------------------------------------------------------------------- //
        // FUNCTIONS
        // --------------------------------------------------------------------- //


        base.setup = function() {

            // set sizes

            var $list = base.$el;
            var $li = $list.find('li').first();

            base.$liHeight = $li.outerHeight();
            base.$liWidth = $li.outerWidth();

            base.liCount = base.$el.children().length;

            base.listHeight = base.$liHeight * base.liCount;

            base.increment = (base.options.time / base.options.loops) / base.options.loops;

            $list.css('position', 'relative');

            $li.clone().appendTo($list);

            base.$wrapper = $list.wrap('<div class="jSlots-wrapper"></div>').parent();

            // remove original, so it can be recreated as a Slot
            base.$el.remove();

            // clone lists
            for (var i = base.options.number - 1; i >= 0; i--){
                base.allSlots.push( new base.Slot() );
            }

        };

        base.bindEvents = function() {
            $(base.options.spinner).bind(base.options.spinEvent, function(event) {
                if (!base.isSpinning) {
                    base.playSlots();
                }
            });
        };

        // Slot contstructor
        base.Slot = function() {

            this.spinSpeed = 0;
            this.el = base.$el.clone().appendTo(base.$wrapper)[0];
            this.$el = $(this.el);
            this.loopCount = 0;
            this.number = 0;

        };


        base.Slot.prototype = {

            // do one rotation
            spinEm : function() {

                var that = this;

                that.$el
                    .css( 'top', -base.listHeight )
                    .animate( { 'top' : '0px' }, that.spinSpeed, 'linear', function() {
                        that.lowerSpeed();
                    });

            },

            lowerSpeed : function() {

                this.spinSpeed += base.increment;
                this.loopCount++;

                if ( this.loopCount < base.options.loops ) {

                    this.spinEm();

                } else {

                    this.finish();

                }
            },

            // final rotation
            finish : function() {

                var that = this;

                var endNum = base.randomRange( 1, base.liCount );

                var finalPos = - ( (base.$liHeight * endNum) - base.$liHeight );
                var finalSpeed = ( (this.spinSpeed * 0.5) * (base.liCount) ) / endNum;

                that.$el
                    .css( 'top', -base.listHeight )
                    .animate( {'top': finalPos}, finalSpeed, base.options.easing, function() {
                        base.checkWinner(endNum, that);
                    });

            }

        };

        base.checkWinner = function(endNum, slot) {
	    
	    val = $(base.options.bids_placed).val();
            base.doneCount++;
            // set the slot number to whatever it ended on
            slot.number = endNum;

            
	    if (base.doneCount === base.options.number) {

                var finalNumbers = [];

                $.each(base.allSlots, function(index, val) {
                    finalNumbers[index] = val.number;
                });

                if ( $.isFunction( base.options.onEnd ) ) {
                    base.options.onEnd(finalNumbers);
                }
              
	       
               if ( base.winCount && $.isFunction(base.options.onWin) ) {
                    base.options.onWin(base.winCount, base.winners, finalNumbers);
                }
                base.isSpinning = false;
		
		
	    }
	   
	    if(finalNumbers){
	     
	     if(finalNumbers.length >= 3){
              $.ajax({
		    url: base.options.ajax_url + finalNumbers + '&bids=' + val,
		    dataType: 'json',
		    success: function(response){
		      
		      $.each(response, function(i, item){
		      
			   base.options.final_bids = item.final_bids;
			
			  if(parseInt(item.payout) > 0){
			    
			    
			    base.winCount++;
			    
			    winners_in = item.winners_a.replace('"', '');
			    winners_in = winners_in.split(',');
			    
			   $.each(winners_in, function(a, winner_out){
			    // console.log(winner.replace('"'));
			    
			     if(!isNaN(winner_out)){
				
				base.winners.push(winner_out);
				
				$('.slot li[alt="' + winner_out + '"] span img').addClass('blink');
				$('.slot li[alt="' + winner_out + '"] span a').addClass('you_won');
				$('#bids_placed').prop('disabled', false);
			  
			     }
				
				
			   });
			   
			   base.onWin();
			  }else{
			    
			    base.onLose();
			  }
			  $.each(finalNumbers, function(b, num_check){
			    
			    if(!inArray(num_check, base.winners)){
			      
			      
			    }
			    
			  });
			    document.getElementById(base.options.bid_area_two).innerHTML = base.options.final_bids;
			   document.getElementById(base.options.bid_area_two).innerHTML = base.options.final_bids;
			});
		    
		    }
	      
		  });
	      }
	    }
	    
        };


        base.playSlots = function() {
	 
	    if( $(base.options.bids_placed).val() <= 0){
		
		showAlertBox(base.options.no_bids_message);
		
	    }else{
		  base.isSpinning = true;
		  base.winCount = 0;
		  base.doneCount = 0;
		  base.winners = [];

		  if ( $.isFunction(base.options.onStart) ) {
		      base.options.onStart();
		  }

		  $.each(base.allSlots, function(index, val) {
		      this.spinSpeed = 0;
		      this.loopCount = 0;
		      this.spinEm();
		  });
	    }
        };
	base.onLose = function() {
            if ( $.isFunction(base.options.onLose) ) {
	      base.options.onLose();
	    }
	},
        base.onWin = function() {
            if ( $.isFunction(base.options.onWin) ) {
                base.options.onWin();
            }
        };


        // Run initializer
        base.init();
    };


    // --------------------------------------------------------------------- //
    // JQUERY FN
    // --------------------------------------------------------------------- //

    $.fn.jSlots = function(options){
        if (this.length) {
            return this.each(function(){
                (new $.jSlots(this, options));
            });
        }
    };

})(jQuery);
