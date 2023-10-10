<?php
if(count($__vars) > 0) {
    $carouselId = 'gallery-' . rand(100, 10000);
?>
<div id="<?php echo esc_attr($carouselId); ?>" class="car-gallery owl-carousel">
    <?php
    foreach ($__vars as $ids) {
        stm_car_rental_load_template('shop/loop/gallery-item', $ids);
    }
    ?>
</div>
<script>
    (function ($) {
        $(document).ready(function () {
            $('#<?php echo esc_js( $carouselId )?>').owlCarousel({
                items: 1,
                margin: 0,
                loop: true,
                dots: false,
                nav: true
            })
        });
    })(jQuery)
</script>
<?php } ?>