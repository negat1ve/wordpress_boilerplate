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
                             <h2 class="b-blog-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                             <?php the_excerpt(); ?>
                         </div>
    	            <?php endwhile; ?>
    	        <?php endif; ?>
            </div>
    	</div>
    </section>
<?php get_footer(); ?>