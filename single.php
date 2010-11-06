<?php get_header(); ?>

      <?php the_post(); ?>

      <h1>
        <a class="covert-link" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h1>
      
      <?php the_content(); ?>

       <div id="last-modified">Last Updated: <?php the_modified_time('F j, Y'); ?> </div> 

      <?php comments_template(); ?>

<?php get_footer(); ?>
