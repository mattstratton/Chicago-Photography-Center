<?php get_header(); ?>

	<div id="content" class="widecolumn">

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
					<div class="postmeta">
						<?php if (comments_open()) : ?><span class="comments"><?php comments_popup_link(__('0 <span>comments</span>', 'notesblog'), __('1 <span>comment</span>', 'notesblog'), __('% <span>comments</span>', 'notesblog'), '', ''); ?></span><?php endif; ?>
						<span class="author"><?php _e("By", "notesblog");?> <a href="<?php the_author_url(); ?>" title="<?php the_author(); ?>" class="author"><?php the_author(); ?></a></span>
					</div>
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
			
			<?php comments_template('', true); ?>

		<?php endwhile; ?>
		
			<div class="nav widecolumn">
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>