<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

	<div id="content" class="widecolumn">
	
	<?php while (have_posts()) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<div class="postmeta">
			    <?php if (comments_open()) : ?><span class="comments"><?php comments_popup_link(__('0 <span>comments</span>', 'notesblog'), __('1 <span>comment</span>', 'notesblog'), __('% <span>comments</span>', 'notesblog'), '', ''); ?></span><?php endif; ?>
			    <span class="author"><?php _e("By", "notesblog");?> <a href="<?php the_author_url(); ?>" title="<?php the_author(); ?>" class="author"><?php the_author(); ?></a></span>
			</div>
			<div class="entry">
				<?php the_content(); ?>
				<h2><?php _e("Browse by Month:", "notesblog");?></h2>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<h2><?php _e("Browse by Category:", "notesblog");?></h2>
				<ul>
					 <?php wp_list_categories('title_li='); ?>
				</ul>
				<h2><?php _e("Browse by Tag:", "notesblog");?></h2>
				<?php wp_tag_cloud('smallest=8&largest=28&number=0&orderby=name&order=ASC'); ?>
			</div>
		</div>
		
	<?php endwhile; ?>
	
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>