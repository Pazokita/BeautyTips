
<?php

function beautytips_classes_list() { ?>
    <ul class="classes-list">
        <?php
            $args = array(
                'post_type' => 'beautytips_classes',
                'posts_per_page' => $number 
            );
            // Use WP_Query and append the results into $classes
            $classes = new WP_Query($args);
            while($classes->have_posts()): $classes->the_post();
        ?>
        <li class="beautytips_classes card gradient">
            <?php the_post_thumbnail('mediumSize'); ?>

            <div class="card-content">
                <a href="<?php the_permalink(); ?>">
                    <h3><?php the_title(); ?></h3>
                </a>
                <?php
                    $start_time = get_field('start_time');
                    $end_time = get_field('end_time');
                ?>
                <p><?php echo the_field('class_days') . " -  " .  $start_time . " to " . $end_time ?></p>
                
            </div>

            

        </li>

        <?php endwhile; wp_reset_postdata(); ?>
    </ul>
<?php }
