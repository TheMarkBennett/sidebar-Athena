
<?php
if( get_field('ucf_theme_sidebar') != "no_sidebar"):
  $bootstrap_classes = "col-xs-12 col-md-8";
else:
  $bootstrap_classes = "col-xs-12";
endif;
?>

  <div id="primary" class="content-area primary <?php echo $bootstrap_classes ?>">
    <div>
      <article id="post-<?php the_ID();?>" class="post-<?php the_ID();?> <?php get_post_type( $post->ID );?> <?php get_post_status( $post->ID );?> ">
        <?php the_content(); ?>
    </div>
    </main>
  </div>
