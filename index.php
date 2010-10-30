<?php get_header(); ?>

      <div class="post-listings">
          <ul>
            <?php while ( have_posts() ) : the_post(); ?>
              <li>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
              </li>
            <?php endwhile; ?>
          </ul>
          <a class="small-text" href="/">« Older Entries</a>
      </div>

<?php get_footer(); ?>
