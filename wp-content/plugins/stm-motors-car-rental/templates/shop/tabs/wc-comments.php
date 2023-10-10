<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

if ( !comments_open() ) {
    return;
}

$args = array( 'post_type' => 'product' );
$comments = get_approved_comments( get_the_ID(), $args );

?>
<div id="reviews" class="mcr-woocommerce-Reviews">
    <div id="comments">
        <?php if ( $comments ) : ?>
            <ol class="commentlist">
                <?php wp_list_comments( array( 'callback' => 'stm_cr_woocommerce_product_review_list_args' ), $comments ); ?>
            </ol>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                echo '<nav class="woocommerce-pagination">';
                paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
                    'prev_text' => '&larr;',
                    'next_text' => '&rarr;',
                    'type' => 'list',
                ) ) );
                echo '</nav>';
            endif; ?>
        <?php endif; ?>
    </div>

    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

        <div id="review_form_wrapper">
            <div id="review_form">
                <?php
                $commenter = wp_get_current_commenter();

				$recaptcha_enabled = stm_me_get_wpcfto_mod('enable_recaptcha',0);
				$recaptcha_public_key = stm_me_get_wpcfto_mod('recaptcha_public_key');
				$recaptcha_secret_key = stm_me_get_wpcfto_mod('recaptcha_secret_key');

				$recaptchaDiv = '';

				if (!empty($recaptcha_enabled) and $recaptcha_enabled and !empty($recaptcha_public_key) and !empty($recaptcha_secret_key)):
                    $recaptchaDiv = '<div class="g-recaptcha" data-sitekey="' . esc_attr($recaptcha_public_key) . '"></div>';
				?>
                    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
                <?php
                endif;
                $comment_form = array(
                    'title_reply' => have_comments() ? __( 'Add a review', 'stm_motors_car_rental' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'stm_motors_car_rental' ), get_the_title() ),
                    'title_reply_to' => __( 'Leave a Reply to %s', 'stm_motors_car_rental' ),
                    'title_reply_before' => '<span id="reply-title" class="comment-reply-title heading-font">',
                    'title_reply_after' => '</span>',
                    'comment_notes_after' => '',
                    'fields' => array(
                        'author' => '<div class="row">' .
                            '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">' .
                            '<p class="comment-form-author">' .
                            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="' . esc_attr__( 'Name', 'stm_motors_car_rental' ) . ' *" /></p>' .
                            '</div>',
                        'email' => '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">' .
                            '<p class="comment-form-email">' .
                            '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="' . esc_attr__( 'Email', 'stm_motors_car_rental' ) . ' *" /></p>' .
							$recaptchaDiv,
                            '</div>' .
                            '</div>',
                    ),
                    'label_submit' => __( 'Submit', 'stm_motors_car_rental' ),
                    'logged_in_as' => '',
                    'comment_field' => ''
                );

                if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                    $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'stm_motors_car_rental' ), esc_url( $account_page_url ) ) . '</p>';
                }

                if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {

                    $label = '<label for="rating">' . esc_html__( 'Rating:', 'stm_motors_car_rental' ) . '</label>';

                    $comment_form['comment_field'] = '<p class="comment-form-rating">' . $label . '<select name="rating" id="rating">
									<option value="">' . esc_html__( 'Rate&hellip;', 'stm_motors_car_rental' ) . '</option>
									<option value="5">' . esc_html__( 'Perfect', 'stm_motors_car_rental' ) . '</option>
									<option value="4">' . esc_html__( 'Good', 'stm_motors_car_rental' ) . '</option>
									<option value="3">' . esc_html__( 'Average', 'stm_motors_car_rental' ) . '</option>
									<option value="2">' . esc_html__( 'Not that bad', 'stm_motors_car_rental' ) . '</option>
									<option value="1">' . esc_html__( 'Very poor', 'stm_motors_car_rental' ) . '</option>
								</select></p>';
                }

                $comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Your review', 'stm_motors_car_rental' ) . '"></textarea></p>';


                comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                ?>
            </div>
        </div>

    <?php else : ?>

        <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'stm_motors_car_rental' ); ?></p>

    <?php endif; ?>

    <div class="clear"></div>
</div>
