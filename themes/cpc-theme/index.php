<?php get_header(); ?>
<div id="content-left">
	<div id="leftbar" class="left-sidebar">
	
	<?php if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'page-single' );
	} else { ?>

		<img src="<?php bloginfo('template_directory'); ?>/images/default-image.jpg" alt="<?php the_title(); ?>" />

<?php } ?>

	</div>
	<div style="margin-top:530px; width:333px;height:10px;"><hr /></div>
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
		<div ID="groupon-box">
		<A href="/groupon">GROUPONS START HERE</a>
	</div>
	<div ID="member-box">
		<A href="/get-involved/become-a-member">BECOME A MEMBER</a>
	</div>
	<div ID="free-box">
		<a href="/instruction/free">FREE FREE FREE!</a>
	</div>
</div>

<div id="content-right">
	<div id="content">
	

	<?php
	if (is_category()) {
   		echo '<h1>';
   		//_e("Category", "notesblog");
   		single_cat_title();
   		echo '</h1>';
   	} if (is_tag()) {
   		echo '<h1 class="listhead">';
   		_e("Tag", "notesblog");
   		echo ' <strong>';
   		single_tag_title();
   		echo '</strong></h1>';
   	} if (is_search()) {
   		echo '<h1 class="listhead">';
   		_e("Your <strong>search result</strong>", "notesblog");
   		echo '</h1>';
   	}
	
	if (is_home()) {
		query_posts("cat=4");
	}
   	?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php
			global $wp_query;
			$post_id = $wp_query->post->ID;
		?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if (is_single()) { ?>
					<h1><?php the_title(); ?></h1>
					<?php if (is_attachment()) { ?>
						<p class="attachmentnav">&larr; <?php _e("Back to", "notesblog");?> <a href="<?php echo get_permalink($post->post_parent) ?>" title="<?php echo get_the_title($post->post_parent) ?>" rev="attachment"><?php echo get_the_title($post->post_parent) ?></a></p>
					<?php } else { ?>
						<div class="postmeta">
							<span class="timestamp"><?php the_time(__('F jS, Y', 'notesblog')) ?> @ <?php the_time(); ?></span>
						</div>
					<?php } ?>
				<?php } elseif (is_page()) { ?>
					<h1><?php the_title(); ?></h1>

				<?php } else { ?>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="postmeta">
						<span class="timestamp"><?php the_time(__('F jS, Y', 'notesblog')) ?> @ <?php the_time(); ?></span>
					</div>
				<?php } ?>

				<div class="entry">
					<?php the_content(__('Read more', 'notesblog')); ?>
				</div>
				<?php if (is_single() || is_page()) { edit_post_link(__('Edit', 'notesblog'), '<p class="admin">Admin: ', '</p>'); wp_link_pages('before=<p class="pagelink">' . __('Pages:', 'notesblog') .' &after=</p>'); } ?>
			</div>
			<?php //if (is_single()){comments_template('', true);} ?>

		<?php endwhile; ?>
		
			<div class="nav widecolumn">
			<?php if (is_attachment()) { ?>
				<div class="left"><?php next_image_link('', __('View previous', 'notesblog')); ?></div>
				<div class="right"><?php previous_image_link('', __('View next', 'notesblog')); ?></div>
			<?php } elseif (is_single()) { ?>
				<?php next_post_link('<div class="right">%link</div>'); ?> 
				<?php previous_post_link('<div class="left">%link</div>'); ?> 
			<?php } else { ?>
				<div class="left"><?php next_posts_link(__('previous', 0)) ?></div>
				<div class="right"><?php previous_posts_link(__('next', 0)) ?></div>
			<?php } ?>
			</div>
		
	<?php else : ?>
		<!-- search found nothing -->
		<?php if (is_search()) { ?>
			<div class="post single">
				<h2><?php _e('We got nothing!','notesblog');?></h2>
				<p><?php _e('Your search query didn\'t return any results. We\'re sorry about that, why don\'t you give it another go, tweaking it a bit perhaps? Use the search box as you did before, maybe you\'ll have more luck.','notesblog');?></p>
				<h3><?php _e('Something to read?','notesblog');?></h3>
				<p><?php _e('Want to read something else? These are the 20 latest updates:','notesblog');?></p>
				<ul><?php wp_get_archives('type=postbypost&limit=20&format=html'); ?></ul>
			</div>
		<?php } ?>
		<!-- 404 page not found -->
		<?php if (is_404()) { ?>
			<h1 class="listhead"><?php _e('This is a <strong>404 Page Not Found</strong>','notesblog');?></h1>
			<div class="post single">
				<h2><?php _e('There\'s nothing here!','notesblog');?></h2>
				<p><?php _e('We\'re sorry, but there is nothing here! You might even call this a <strong>404 Page Not Found</strong> error message, which is exactly what it is. The page you\'re looking for either doesn\'t exist, or the URL you followed or typed to get to it is incorrect in some way.','notesblog');?></p>
				<p><?php _e('<strong>Why don\'t you try and search for it?</strong> Use the search box and try to think of a suitable keyword query, and you\'ll probably be fine.','notesblog');?></p>
				<p><?php _e('You\'re sure that it should be here, that page you were looking for? <a href="/contact">Then tell us about it!</a>','notesblog');?></p>
				<h3><?php _e('Something to read?','notesblog');?></h3>
				<p><?php _e('Want to read something else? These are the 20 latest updates:','notesblog');?></p>
				<ul><?php wp_get_archives('type=postbypost&limit=20&format=html'); ?></ul>
			</div>
		<?php } ?>
	<?php endif; ?>

	</div>
</div>
	<?php get_footer(); ?>