<?php get_header(); ?>

      <?php the_post(); ?>

      <h1>
        <a class="covert-link" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h1>
      
      <?php the_content(); ?>

      <div id="last-modified">Last Updated: <?php the_modified_time('F j, Y'); ?> </div> 

      <!-- AddThis Button BEGIN -->
      <div class="addthis_toolbox addthis_default_style ">
         <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
         <a class="addthis_button_tweet"></a>
         <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
         <a class="addthis_counter addthis_pill_style"></a>
      </div>
      <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f4a67a01829dff7"></script>
      <!-- AddThis Button END -->

      <?php comments_template(); ?>

<?php get_footer(); ?>
