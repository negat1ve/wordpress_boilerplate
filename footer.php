<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		    <div class="b-credits">
                <div class="b-credits__container">
                    <?php dynamic_sidebar( 'credits' ); ?>
                    <p class="b-credits__copyright"><span>© 2013. William Edwards MD. All rights reserved.  | </span><a href="http://36creative.com/" class="copyright" target="_blank"><span class="icon"><span class="t"></span></span></a></p>
                    <a class="b-credits__close"></a>
                </div>
            </div>
        </div>
        <div class="c-menu-mobile">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </div>
		<footer class="c-footer">
            <a class="l-credits">Credits</a>
            <nav class="b-nav">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'b-nav__menu' ) ); ?>
                <!-- <ul class="b-nav__menu">
                    <li class="b-nav__menu-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>about/">About 103</a>
                        <div class="b-nav__dropdown">
                            <ul class="b-nav__col">
                                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>suite-rewards/">Suite Rewards</a></li>
                                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>our-team/">Our Team</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="b-nav__menu-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>services/">Services</a>
                    </li>
                    <li class="b-nav__menu-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>beauty-resources/">Beauty Resources</a>
                         <div class="b-nav__dropdown">
                            <ul class="b-nav__col">
                                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>self-diagnosis/">Self Diagnosis</a></li>
                                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>beauty-at-any-age/">Beauty at Any Age</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="b-nav__menu-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>products/">Products</a>
                         <div class="b-nav__dropdown">
                            <ul class="b-nav__col">
                                <?php $query = new WP_Query( array( 'post_type' => 'product', 'posts_per_page' => -1 ) ); ?>
                                <?php if ( $query->have_posts() ) : ?>
                                <?php while ( $query->have_posts() ) : $query->the_post();?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                                <?php wp_reset_query(); ?>
                            </ul>
                        </div>
                    </li>
                    <li class="b-nav__menu-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>specials/">Specials</a>
                    </li>
                    <li class="b-nav__menu-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>blog/">Blog</a>
                    </li>
                    <li class="b-nav__menu-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>contact/">Contact</a>
                    </li>
                </ul> -->
            </nav>
            <ul class="b-socials">
                <li class="b-socials__item b-socials__item_facebook"><a href="">Facebook</a></li>
                <li class="b-socials__item b-socials__item_twitter"><a href="">Twitter</a></li>
                <li class="b-socials__item b-socials__item_pinterest"><a href="">Pinterest</a></li>
            </ul>
            <div class="b-my-whish-list"><a href="<?php echo esc_url( home_url( '/' ) ); ?>my-wish-list/" class="b-my-whish-list__link">My Wish List</a></div>
        </footer>

        <!--[if IE 8]>
        <script>window.isMsIe = 8;</script><![endif]-->
        <!--[if lte IE 7]>
        <script>window.isMsIe = 7;</script><![endif]-->
        
        <?php wp_footer(); ?>
    </body>
</html>