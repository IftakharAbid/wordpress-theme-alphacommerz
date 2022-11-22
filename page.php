<?php get_header(); ?>

<div id="box">

  <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

  <div class="post">

    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

  <div class="entry" >

    <?php the_content(); ?>


  </div>
</div>

<?php endwhile; ?>
  
</div>
<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>