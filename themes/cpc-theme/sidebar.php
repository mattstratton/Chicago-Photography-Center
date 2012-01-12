<ul id="sidebar" class="column">

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
		<li id="search">
			<h2><?php _e("Search", "notesblog"); ?></h2>
			<?php get_search_form(); ?>
		</li>
		<li id="tag_cloud">
			<h2><?php _e("Tag Cloud", "notesblog");?></h2>
			<?php wp_tag_cloud('smallest=10&largest=20&unit=px'); ?>
		</li>
		<?php wp_list_categories('title_li=<h2>' .__('Categories') . '</h2>'); ?> 
		<?php wp_list_pages('title_li=<h2>' .__('Pages') . '</h2>'); ?>
		<?php wp_list_bookmarks(); ?> 
	<?php endif; ?>

</ul>