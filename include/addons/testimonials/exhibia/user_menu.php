<li>
   <h5><?php echo AUCTIONS; ?></h5>
    <ul>
        <li><a href="javascript:;" onclick="ajax_testimonials('include/addons/testimonials/add_testimonials.php', 'add');" class="<?php echo ($currentPage == 'mycoupon.php')?'selected':''; ?>"><?php echo ADD_TESTIMONIAL; ?></a></li>
        <li style="background: transparent none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
            <a href="javascript:;" onclick="ajax_testimonials('include/addons/testimonials/view_testimonials.php', 'edit');" class="<?php echo ($currentPage == 'couponhistory.php')?'selected':''; ?>"><?php echo VIEW_TESTIMONIALS; ?></a>
        </li>
    </ul> 
</li>
    
    
    <script>
    
    var testimonials_box = "#column-right";
    var tab = '#myqb h2.tabs';
    
    function ajax_testimonials(url, add_or_get){
    
	$.get(url, function(data){
	  
	
	    $(testimonials_box).html(data);
	  
	});
	
    }
    </script>