<?php
get_header(); ?>
	<section class="c-container">
		<div class="c-blog">
            <div class="c-blog__scroll-area">
    	        <?php if ( have_posts() ) : ?>
    	            <?php while ( have_posts() ) : the_post(); ?>
    	            	<div class="b-blog-post">
    	                    <?php if ( has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                                 the_post_thumbnail();
                             } ?>
                             <span class="b-blog-post_entry-date"><?php echo get_the_date("m/d/Y"); ?></span>
                             <h1 class="b-blog-post__title"><?php the_title(); ?></h1>
                             <?php the_content(); ?>
                         </div>
    	            <?php endwhile; ?>
    	        <?php endif; ?>
            </div>
    	</div>
    </section>
<?php get_footer(); ?>