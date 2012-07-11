<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

<div id="content-left">
	<div id="fadebox">
		community.
	</div>
	<div style="margin-top:354px; width:333px;height:10px;"><hr /></div>
	<div ID="location-box">
		3301 N. Lincoln Avenue<br />
		Chicago, IL 60657<br />
		Phone: (773) 549-1631<br />
		<a href="/who-we-are/our-facility">HOURS</a> <a href="/">|</a> <a href="/contact">CONTACT</a> <a href="/">|</a> <a href="http://maps.google.com/maps?oe=utf-8&client=firefox-a&ie=UTF8&q=3301+N.+Lincoln+Avenue,+Chicago,+IL+60657&fb=1&split=1&gl=us&cid=0,0,2292686454574168843&ei=c6MAStPHBpCyMbevheoH&ll=41.946724,-87.669353&spn=0.013406,0.025406&z=16" target="new">MAP IT</a>
	</div>
	<div ID="social-box">
		<a href="https://www.facebook.com/ChicagoPhotographyCenter"><img src = "<?php bloginfo('stylesheet_directory')?>/images/social/facebook.png"></a>
		<a href="http://twitter.com/ChicagoPhotoCtr"><img src = "<?php bloginfo('stylesheet_directory')?>/images/social/twitter.png"></a>
		<A href="http://www.flickr.com/people/chicagophotographycenter/"><img src = "<?php bloginfo('stylesheet_directory')?>/images/social/flickr.png"></a>
		<a href="/feed"><img src = "<?php bloginfo('stylesheet_directory')?>/images/social/rss.png"></a>

	</div>
	<!-- removing groupon box
	<div ID="groupon-box">
		<A href="/groupon">GROUPONS START HERE</a>
	</div>-->	
	<div ID="member-box">
		<A href="/get-involved/become-a-member">BECOME A MEMBER</a>
	</div><!-- removing free box
	<div ID="free-box">
		<a href="/instruction/free">FREE FREE FREE!</a>
	</div>-->
</div>
<div id="content-right">
	<div id="slider" class="nivoSlider">
		<img src="/wp-content/uploads/slider/01.jpg" alt=""/>
		<img src="/wp-content/uploads/slider/02.jpg" alt=""/>
		<img src="/wp-content/uploads/slider/03.jpg" alt="" />
		<img src="/wp-content/uploads/slider/04.jpg" alt="" />
		<img src="/wp-content/uploads/slider/05.jpg" alt=""/>
		<img src="/wp-content/uploads/slider/06.jpg" alt=""/>
		<img src="/wp-content/uploads/slider/07.jpg" alt="" />
		<img src="/wp-content/uploads/slider/08.jpg" alt="" />
		<img src="/wp-content/uploads/slider/09.jpg" alt="" />
		<img src="/wp-content/uploads/slider/10.jpg" alt="" />
	</div>
	<div><hr /></div>
	<div id="content">

					<?php
					if (is_page() ) {
					$category = get_post_meta($posts[0]->ID, 'category', true);
					}
					if ($category) {
					  $cat = get_cat_ID($category);
					  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					  $post_per_page = 3; // -1 shows all posts
					  $do_not_show_stickies = 1; // 0 to show stickies
					  $args=array(
						'category__in' => array($cat),
						'orderby' => 'date',
						'order' => 'DESC',
						'paged' => $paged,
						'posts_per_page' => $post_per_page,
						'caller_get_posts' => $do_not_show_stickies
					  );
					  $temp = $wp_query;  // assign orginal query to temp variable for later use   
					  $wp_query = null;
					  $wp_query = new WP_Query($args); 
					  remove_filter( 'the_excerpt', 'wpautop' );
					  if( have_posts() ) : 
							while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
							<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							<h2><?php the_title(); ?></h2>
							  <?php the_excerpt(); ?><BR/><BR/>
							  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">>>LEARN MORE</a>							  <br />							  <hr style="height: 2px;"/>
						  </div>
						<?php endwhile; ?>
					  <?php else : ?>

							<h2 class="center">Not Found</h2>
							<p class="center">Sorry, but you are looking for something that isn't here.</p>
							<?php get_search_form(); ?>

						<?php endif; 
						
						$wp_query = $temp;  //reset back to original query
						
					}  // if ($category)
					?>

	</div>




</div>



<?php get_footer(); ?>