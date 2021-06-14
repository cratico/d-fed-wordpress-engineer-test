<?php get_header(); ?>

    <?php 

    $latest_posts = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3
    ));
    
    ?>
    <!-- Slider =========================================== -->
    <section id="banner" class="main__banner <?php echo !$latest_posts->have_posts() ? 'main__banner--empty': ''; ?>">
        <?php if(has_post_thumbnail()): ?>
        <!-- Background -->
        <img class="main__banner--image" src="<?php the_post_thumbnail_url('full'); ?>" alt="">
        <?php endif; ?>

        <div class="container">
            <div class="banner__content">
                <?php if( get_field('home_banner_subtitle') ): ?>
                    <h4 class="banner__subtitle"><?php the_field('home_banner_subtitle'); ?></h4>
                <?php endif; ?>

                <?php if( get_field('home_banner_title') ): ?>
                <h2 class="banner__title"><?php the_field('home_banner_title'); ?></h2>
                <?php endif; ?>
                    
                    
                <?php if( get_field('home_banner_button_label') ) {
                    $banner_href = get_field('home_banner_button_href') ? 'href="'.get_field('home_banner_button_href').'"' : '';
                    if(get_field('home_banner_button_file')) {
                        $banner_href = 'href="'.get_field('home_banner_button_file')['url'].'"';
                    }
                    printf('<a target="_blank" class="btn btn--primary btn--banner" %s>%s</a>', $banner_href, get_field('home_banner_button_label'));
                }  ?>
            </div>
        </div>
    </section>
    
    <?php if($latest_posts->have_posts()): ?>
    <!-- Articles ========================================= -->
    <section id="articles" class="articles__wrapper">
        <div class="container">
            <div class="article__row">
                <div class="article__list">
                    <?php while($latest_posts->have_posts()): $latest_posts->the_post(); ?>
                    <!-- Post Item -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post__item'); ?>>
                        <div class="post__item--inside">
                            <!-- Thumbnail -->
                            <a href="<?php the_permalink(); ?>" class="post__thumb thumb">
                                <?php if(has_post_thumbnail()) { the_post_thumbnail('post-preview'); } ?>
                            </a>
                            <!-- Post Data -->
                            <div class="post__data">
                                <h3 class="post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post__date"><?php echo get_the_date(); ?></div>
                                <div class="post__content"><?php echo mytest_get_excerpt(200); ?></div>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

    <!-- Content ========================================= -->
    <section id="content" class="main__content">
        <div class="container">
            <?php $feature_thumb = get_field('home_feature_image'); ?>
            <?php if($feature_thumb): ?>
            <div class="main__column--left">
                <div class="feature__thumb thumb"><div class="feature__thumb--inside"><?php echo wp_get_attachment_image(intval($feature_thumb), 'square'); ?></div></div>
            </div>
            <?php endif; ?>
            <div class="main__column--right <?php echo !$feature_thumb ? 'main__column--full' : ''; ?>">
                <div class="feature__content">
                    <?php if( get_field('home_feature_title') ): ?>
                        <h2 class="feature__title"><?php the_field('home_feature_title'); ?></h2>
                    <?php endif; ?>

                    <?php if( get_field('home_feature_subtitle') ): ?>
                        <h3 class="feature__subtitle"><?php the_field('home_feature_subtitle'); ?></h3>
                    <?php endif; ?>
                    
                        
                    <?php if( get_field('home_feature_content') ): ?>
                    <div class="feature__description">
                        <?php echo wpautop(get_field('home_feature_content')); ?>
                    </div>
                    <?php endif; ?>

                    <?php if( get_field('home_feature_button_label') ) {
                    $feature_href = get_field('home_feature_button_href') ? 'href="'.get_field('home_feature_button_href').'"' : '';
                    if(get_field('home_feature_button_file')) {
                        $feature_href = 'href="'.get_field('home_feature_button_file')['url'].'"';
                    }
                    printf('<a target="_blank" class="btn btn--primary btn--feature" %s>%s</a>', $feature_href, get_field('home_feature_button_label'));
                }  ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>