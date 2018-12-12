<div class="ucf-container container">
  <div class="row">
    <?php
        if(get_field('ucf_theme_sidebar') == "left_sidebar"):
          get_sidebar('');
        endif; //adds left sidebar

         get_template_part( 'template-parts/content', 'primary' ); //full width
  
      if(get_field('ucf_theme_sidebar') == "right_sidebar"):
        get_sidebar('');
      endif;
     ?>
  </div>
</div>
