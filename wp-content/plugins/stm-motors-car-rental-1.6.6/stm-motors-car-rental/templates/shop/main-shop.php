<?php
global $wp_query;

if(!stm_mcr_check_valid_rent_info()) {
	wc_add_notice( __( "Please specify Rent Location", 'stm_motors_car_rental' ), 'notice' );
}

if ( have_posts() ):
    $template = (!empty($_GET['view-type'])) ? $_GET['view-type'] : 'list';
    ?>
    <div class="stm_notices">
        <?php wc_print_notices(); ?>
    </div>
    <?php
    if($template == 'grid') echo '<div class="row grid-view">';
    while ( have_posts() ):
        the_post();
        stm_car_rental_load_template('shop/loop/' . $template);
    endwhile;
    if($template == 'grid') echo '</div>';
    ?>

    <script>
        (function ($) {
            $(document).ready(function () {
                var stmHash = window.location.hash;
                var headerOffset = 0;
                if ($('.header-listing').hasClass('header-listing-fixed')) {
                    headerOffset = $('.header-listing').outerHeight();
                }
                if ($(stmHash).length) {
                    $('html, body').animate({
                        scrollTop: $(stmHash).offset().top - headerOffset
                    }, 500);
                    $(stmHash).find('.stm-more').toggleClass('active');
                    $(stmHash).find('.more').slideToggle();
                }
            })
        })(jQuery);
    </script>
<?php else: ?>
    <h2>
        <?php echo esc_html__( "There are no cars in this office", "motors" ); ?>
    </h2>
<?php endif; ?>

<?php
echo paginate_links( array(
    'type' => 'list',
    'prev_text' => '<i class="fas fa-angle-left"></i>',
    'next_text' => '<i class="fas fa-angle-right"></i>',
) );
?>
