    <!-- Footer ========================================== -->
    <footer id="footer" class="footer__wrapper">
        <div class="container">
            <?php 
            
            if($phone = get_theme_mod('mytest_phone')) {
                printf('<div class="footer__phone">%s <a target="_blank" href="tel:%s">%2$s</a></div>', __('PHONE:', THEME_DOMAIN), esc_attr($phone));
            } 

            $copyright = get_theme_mod('mytest_copyright');
            printf('<div class="footer__copyright">%s <a target="_blank" href="%s">%s</a></div>', 
                $copyright ? $copyright : __('© COPYRIGHT '.Date('Y')),
                'https://designory.com', 'DESIGNORY.COM'
            );

            ?>
        </div>
    </footer>
    
    <?php wp_footer(); ?>
</body>
</html>