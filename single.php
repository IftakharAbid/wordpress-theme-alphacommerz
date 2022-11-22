<?php get_header(); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<div id="container" class="container single_post_detail">
<div class="row">
  <div class="col-md-8">
  <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
      <p class="postmetadata_single">
        
      <?php 
      $category_detail=get_the_category();//$post->ID ?>

      <?php echo $category_detail[1]->cat_name ?> 
            <span>&#47;</span>
          <?php  the_author(); ?>
         

      </p>
  <h2 class="single_post_title">
                    <?php the_title(); ?></h2>

                <div class="single_entry" style="font-family:Inter">

                  <?php the_content(); ?>

                  <p class="postmetadata">
          
          
          <?php 
          // comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); 
   
          // edit_post_link('Edit', ' &#124; ', '');
           ?>
                  </p>

                </div>
        <!-- <div class="comments-template">
            <?php 
            // comments_template(); 
            ?>
        </div> -->
</div>

<?php endwhile; ?>

<div class="navigation">
 <p style="float:left; color: #FCB432;width: 40%;"><?php previous_post_link('%link') ?></p>  <p style="float:right; color: #FCB432;width: 40%;"> <?php next_post_link(' %link') ?></p> 
</div>

<?php endif; ?>
  </div>
  <div class="col-md-4"style="font-family: 'Space Grotesk';"><?php get_sidebar(); ?></div>
</div>
  
  

  <?php
$query = new WP_Query(array(
  'post_status'   => 'publish',
  'orderby'       => 'rand',
  'order'         => 'ASC',
  'posts_per_page'    => 3
  ));

$post_count = $query->post_count;
$posts_per_column = ceil($post_count / 3);      

$rows = array();                                            
$count = 0;
while ($query->have_posts())
{ $query->the_post(); 
if($rows[$count] == ""){ $rows[$count] = '<div class="row single_related_post_row">'; }

$category_detail=get_the_category();//$post->ID
										


$rows[$count] = $rows[$count] . '<div class="col-md-4"> <div class="single_related_box">' .


'<div class="single_related_post_thumbnail_block"> '.'<img class="featured_post_thumbnail" src="'.get_the_post_thumbnail_url(null,'medium').' ">' .'</div>'.
'<div class="single_related_post_category"><div class="single_related_post_under_category"> '. $category_detail[1]->cat_name .'</div></div>'.
'<div class="single_related_post_date"> '.get_the_date().'</div>'.
'<div class="single_related_post_title">
<a class="single_related_post_title_anchor" href="'.get_permalink().'">'. get_the_title().'</a></div>' .
'<div class="single_related_post_view">
<a class="single_related_post_view_anchor" href="'.get_permalink().'"> View Article >> </a></div></div></div>';
$count++;                           
if ($count == $posts_per_column ) { $count = 0; }   
}

foreach ($rows as $row) { echo $row . '</div>'; }
?>



</div>


<?php get_footer(); ?>
<div class="container">


</div>