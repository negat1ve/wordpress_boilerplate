<?php
get_header(); ?>
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <section class="c-container c-container-individual-product">
            <div class="b-left-side">
                <div class="b-image-container">
                    <?php if ( has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail('left-side-image', array('class' => 'b-image-container__image'));
                    } ?>
                </div>
            </div>
            <div class="b-right-side">
                <div class="b-scroll-section">
                    <div class="b-scroll-section__padding">
                        <div class="b-scroll-section__scroll-pane">
                            <div class="b-scroll-section__vertical-align">
                                <article class="b-individual-article">
                                    <h1 class="b-title"><?php the_title(); ?></h1>
                                    <?php the_content(); ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>products/" class="l-btn">See all products</a>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endwhile; ?>
    <?php endif; ?>
<?php get_footer(); ?>