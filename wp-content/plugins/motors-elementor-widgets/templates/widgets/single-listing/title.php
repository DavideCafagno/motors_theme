<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$listing_title = stm_generate_title_from_slugs( $listing_id, false );
?>
<<?php echo esc_attr( $title_tag ); ?> class="title stm_listing_title">
<?php echo esc_html( $listing_title ); ?>
</<?php echo esc_attr( $title_tag ); ?>>
