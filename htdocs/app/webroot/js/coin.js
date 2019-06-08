// Coin - Script base
jQuery(document).ready(function() {

  // FilterForm
  jQuery(".filterFormActivator").click(
    function() {
      jQuery(".filterForm").fadeIn(150);
    }
  );

  // Main menu
  jQuery('.pdMenu li').hover(
        function () {
            //show its submenu
            jQuery('ul', this).slideDown(100);
 
        },
        function () {
            //hide its submenu
            jQuery('ul', this).slideUp(100);        
        }
    );

  // Tweet countdown
  jQuery('.tweet_input').on('keyup', 
    function () {
      var short = false;
      var left = 140;
      var pattern = /http[s]{0,1}\:\/\/[^\ ]+/gm;
      while((r = pattern.exec($(this).val())) != null) {
        if (r[0].length > 20) {
          left += r[0].length - 20;
          short = true;
        }
      }
      left -= $(this).val().length;
      jQuery('#twleft_'+jQuery(this).attr('id')).text(left+((short)?' - Link will appear shortened':''));
    }
  );

  // Tooltip
  jQuery(".withTooltip").hover(
    function() {
      jQuery(this).find(".tooltip").fadeIn(150);
    },
    function() {
      jQuery(this).find(".tooltip").fadeOut(150);
    }
  );

  }
);

// Modal
function start_wait() {
  jQuery(".loading-modal").each(function(index) {
      $(this).show();
    });
}
function end_wait() {
  jQuery(".loading-modal").each(function(index) {
      $(this).hide();
    });
}
