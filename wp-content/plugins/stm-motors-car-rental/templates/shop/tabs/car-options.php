<?php
$args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => '15',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_type',
            'field' => 'slug',
            'terms' => 'car_option',
        )
    )
);

$p = new WP_Query( $args );
if ( $p->have_posts() ):
    ?>
    <div class="stm_rental_options_archive">
        <?php
        while ( $p->have_posts() ):
            $p->the_post();
            stm_car_rental_load_template( 'shop/loop/option', array('invisId' => $__vars['invisId']));
        endwhile;
        ?>
        <script>
            jQuery(document).ready(function () {
                var $ = jQuery;
                $('.stm-manage-stock-yes a').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var stmHref = $(this).attr('href');
                    var quantityValue = $(this).closest('.meta').find('.qty').val();
                    var quantity = '&quantity=' + quantityValue;
                    stmHref += quantity;
                    window.location.href = stmHref;
                });
            });
        </script>
    </div>
<?php endif;
wp_reset_postdata();