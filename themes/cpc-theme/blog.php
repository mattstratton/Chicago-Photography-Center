<?php
/*
Template Name: Blog Main Page
*/
?>

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
		<a href="http://www.giltcity.com/chicago"><img src = "<?php bloginfo('stylesheet_directory')?>/images/social/gilt.png"></a>
		<a href="/feed"><img src = "<?php bloginfo('stylesheet_directory')?>/images/social/rss.png"></a>
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
   		echo '<h1 class="listhead">';
   		_e("Category", "notesblog");
   		echo ' <strong>';
   		single_cat_title();
   		echo '</strong></h1>';
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
							<?php if (comments_open()) : ?><span class="comments"><?php comments_popup_link(__('0 <span>comments</span>', 'notesblog'), __('1 <span>comment</span>', 'notesblog'), __('% <span>comments</span>', 'notesblog'), '', ''); ?></span><?php endif; ?>
							<span class="author"><?php _e("By", "notesblog");?> <a href="<?php the_author_url(); ?>" title="<?php the_author(); ?>" class="author"><?php the_author(); ?></a></span>
							<span class="categories"><?php _e("Filed in", "notesblog");?> <?php the_category(', '); ?></span>
							<span class="tags"><?php the_tags(__('Tagged with ', 'notesblog'),', ',''); ?></span>
							<span class="timestamp"><?php the_time(__('F jS, Y', 'notesblog')) ?> @ <?php the_time(); ?></span>
						</div>
					<?php } ?>
				<?php } elseif (is_page()) { ?>
					<h1><?php the_title(); ?></h1>

				<?php } else { ?>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="postmeta">
						<?php if (comments_open()) : ?><span class="comments"><?php comments_popup_link(__('0 <span>comments</span>', 'notesblog'), __('1 <span>comment</span>', 'notesblog'), __('% <span>comments</span>', 'notesblog'), '', 'Comments are closed'); ?></span><?php endif; ?>
						<span class="author"><?php _e("By", "notesblog");?> <a href="<?php the_author_url(); ?>" title="<?php the_author(); ?>" class="author"><?php the_author(); ?></a></span>
						<span class="categories"><?php _e("Filed in", "notesblog");?> <?php the_category(', '); ?></span>
						<span class="tags"><?php the_tags(__('Tagged with ', 'notesblog'),', ',''); ?></span>
						<span class="timestamp"><?php the_time(__('F jS, Y', 'notesblog')) ?> @ <?php the_time(); ?></span>
					</div>
				<?php } ?>

				<div class="entry">
					<?php the_content(__('Read more', 'notesblog')); ?>
				</div>
				<?php if (is_single() || is_page()) { edit_post_link(__('Edit', 'notesblog'), '<p class="admin">Admin: ', '</p>'); wp_link_pages('before=<p class="pagelink">' . __('Pages:', 'notesblog') .' &after=</p>'); } ?>
			</div>
			<?php if (is_single()){comments_template('', true);} ?>

		<?php endwhile; ?>
		
			<div class="nav">
			<?php if (is_attachment()) { ?>
				<div class="left"><?php next_image_link('', __('View previous', 'notesblog')); ?></div>
				<div class="right"><?php previous_image_link('', __('View next', 'notesblog')); ?></div>
			<?php } elseif (is_single()) { ?>
				<?php next_post_link('<div class="right">%link</div>'); ?> 
				<?php previous_post_link('<div class="left">%link</div>'); ?> 
			<?php } else { ?>
				<div class="left"><?php next_posts_link(__('Read previous entries', 'notesblog')) ?></div>
				<div class="right"><?php previous_posts_link(__('Read more recent entries', 'notesblog')) ?></div>
			<?php } ?>
			</div>
		
	<?php else : ?>
	<?php endif; ?>

	</div>
</div>
	<?php get_footer(); ?>