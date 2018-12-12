<?php get_header(); the_post(); ?>

<div id="content" class="<?php echo $post->post_status; ?> post-list-item site-content">

<?php
	if(get_field('ucf_theme_content_layout') == "container-fluid"):
		get_template_part( 'template-parts/content', 'full-width' ); //full width
	else:
		get_template_part( 'template-parts/content', 'boxed' ); //boxed content
	endif;
?>
</div>

<?php get_footer(); ?>
