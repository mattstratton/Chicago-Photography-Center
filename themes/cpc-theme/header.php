<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php if (is_home () ) { bloginfo('name'); } elseif (is_category() || is_tag()) { single_cat_title(); echo ' &bull; ' ; bloginfo('name'); } elseif (is_single() || is_page()) { single_post_title(); } else { wp_title('',true); } ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/nivo-slider.css" type="text/css" media="screen" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="/favicon.ico" />
<?php wp_head(); ?>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="http://use.typekit.com/jno7kkt.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory')?>/includes/hoverIntent.js"></script> 
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory')?>/includes/superfish.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory')?>/includes/jquery.nivo.slider.pack.js"></script>

<script type="text/javascript"> 
// initialise Superfish 
$(document).ready(function(){ 
  $("ul.sf-menu").superfish({ 
animation: {opacity:'show',height:'show'}, // fade-in and slide-down animation
delay: 500, // 0.5 second delay on mouseout 
autoArrows:  false, 
speed: 'normal'
  }); 
}); 
</script>
<!--fadebox-->
<script type="text/javascript">
$(document).ready(function(){
(function($) {
    $.fn.cycle = function(arr, options) {
        var settings = {
            'delay': 5000,
            'transitionDuration': 500,
            'transitionEasing': 'swing'
        };

        if (options) $.extend(settings, options);

        return this.each(function(ndx, el) {
            $(el).data('cycle:i', 0);
            setInterval(function(el, settings, arr) {
                $(el).fadeOut(settings['transitionDuration'], settings['transitionEasing'], function() {
                    var t = $(this);
                    var i = t.data('cycle:i');
                    i = i == arr.length - 1 ? 0 : i+1;
                    t.data('cycle:i', i)
                        .html(arr[i])
                        .fadeIn(settings['transitionDuration'], settings['transitionEasing']);
                    });
            }, settings['delay'], el, settings, arr);
        });
    };
})(jQuery);


$('#fadebox').cycle(['community.', 'learning.', 'inspiration.'], {
    delay: 10000,
    transitionDuration: 300,
    transitionEasing: 'linear'
});
}); 
</script>
<!-- Set up the Nivo Slider -->
<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#slider').nivoSlider({
		effect: 'slideInLeft', // Specify sets like: 'fold,fade,sliceDown'
		directionNavHide: true, // Only show on hover
		directionNav:false,
		controlNav: false, // 1,2,3... navigation
		animSpeed: 300, // Slide transition speed
        pauseTime: 5000, // How long each slide will show
	
	});
});
</script>

<?php
$theme_name = 'cpc-theme';
$theme_data = get_theme_data( get_theme_root() . '/' . $theme_name . '/style.css' );
?>
<!--Version number: <?php $theme_data['Version']; ?>-->

</head>
<body <?php body_class(); ?>>
<div id="site">
	<div id="headerbar">
				<div class="donatebutton">
				<form name="PrePage" method = "post" action = "https://Simplecheckout.authorize.net/payment/CatalogPayment.aspx"> 
				<input type = "hidden" name = "LinkId" value ="ff6975f2-ba13-4f6d-be82-e49501762351" /> 
				<input type = "image" src ="<?php bloginfo('stylesheet_directory')?>/images/donate-now.png" border=0> </form>
				</div>
				<div id="logo">
					<A href="/"><img src="<?php bloginfo('stylesheet_directory')?>/images/cpc-logo.png" border=0></a>
				</div>
				<div id="searchbox">
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				</div>
	</div> <!--end headerbar-->

			<div id="navmenu">
				<div id="ribbonbar">
					<img src = "/wp-content/themes/cpc-theme/images/redribbon.png">
				</div>
				<?php wp_nav_menu( array(
					'container' => 'nav', /* default is 'div' */
					'container_class' => 'header-nav',
					'menu_class' => 'sf-menu', 
					'theme_location' => 'header-menu' 
					) )?><!--.header-nav-->
			</div><!--end navmenu-->

<div id="page">