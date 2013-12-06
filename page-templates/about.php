<?php
/**
 * Template Name: About
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <?php $color = get_post_meta($post->ID, 'background_color', true); ?>
        <section class="c-container"<?php if (!empty($color)) echo " style=\"background-color: " . $color ."\""; ?>>
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
                                    <h1 class="b-title">Beauty is for everyone</h1>
                                    <?php the_content(); ?>
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