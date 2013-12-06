<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
    <section class="c-container">
        <div class="b-left-side">
            <div class="b-image-container">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/about.jpg" class="b-image-container__image" alt=""/>
            </div>
        </div>
        <div class="b-right-side">
            <div class="b-scroll-section">
                <div class="b-scroll-section__padding">
                    <div class="b-scroll-section__scroll-pane">
                        <div class="b-scroll-section__vertical-align">
                            <article class="b-individual-article">
                                <h1 class="b-title b-right-side__title_page-404">Error 404</h1>
                                <p>Opps. The page can not be found.</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>