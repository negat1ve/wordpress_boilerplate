<?php
/**
 * The template for displaying the footer.
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
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'b-nav__list') ); ?>
        </div>
		<footer class="c-footer">
            <a class="l-credits">Credits</a>
            <nav class="b-nav">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'b-nav__list') ); ?>
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