<?php

function wp_date_posts($atts) {
    $atts = shortcode_atts(
        array(
            'from' => '',
            'to' => '',
        ),
        $atts,
        'wp_date_posts'
    );

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
            array(
                'after' => $atts['from'],
                'before' => $atts['to'],
                'inclusive' => true,
            ),
        ),
    );

    $query = new WP_Query($args);
    ob_start(); ?>

    <div class="article-container">
        <?php if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="article-item" data-article-id="<?php the_ID(); ?>">
                    <?php if(get_the_post_thumbnail_url()) { ?>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <?php } ?>
                    <p class="article-date"><?php echo get_the_date('d.m.Y'); ?></p>
                    <h4 class="article-title"><?php the_title(); ?></h4>
                </div>
            <?php endwhile;
        else :
            echo '<p>No articles found</p>';
        endif; ?>

        <div class="popup">
            <div class="popup-content">
                <h3 class="popup-title"></h3>
                <div class="popup-excerpt"></div>
                <a class="popup-link" href="" target="_blank">Read more</a>
            </div>
        </div>
    </div>

    <?php wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('wp_date_posts', 'wp_date_posts');