<?php get_header(); ?>

      <?php the_post(); ?>

      <h1 class="entry-title">
        <a class="covert" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h1>
      
      <div class="entry-date">
        Posted on <?php the_time('l, F jS, Y'); ?>
      </div>

      <div class="entry-content">
        <?php the_content(); ?>
      </div>

      <hr class="thin"/>

      <?php comments_template(); ?>

<?php get_footer(); ?>
