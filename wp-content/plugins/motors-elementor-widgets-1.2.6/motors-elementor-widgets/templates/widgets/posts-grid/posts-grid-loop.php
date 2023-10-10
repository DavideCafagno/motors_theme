<?php

$blog_show_excerpt = stm_me_get_wpcfto_mod( 'blog_show_excerpt', false );
$imgSize           = ( stm_motors_is_unit_test_mod() && stm_is_car_dealer() ) ? 'full' : 'stm-img-350-181';
$imgSize           = ( stm_is_aircrafts() ) ? 'stm-img-350-255' : $imgSize;

?>

<?php if ( 'date_labeled' === $style ) : ?>

	<?php
	$date      = get_the_date( 'd - M' );
	$dateParse = explode( ' - ', $date );
	?>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="post-grid-single-unit recent-post-item">
			<div class="img">
				<!--Sticky Post-->
				<?php if ( is_sticky( get_the_ID() ) ) : ?>
					<div class="sticky-post heading-font"><?php esc_html_e( 'Sticky Post', 'motors-elementor-widgets' ); ?></div>
				<?php endif; ?>
				<a href="<?php echo esc_url( get_the_permalink() ); ?>">
					<?php the_post_thumbnail( $imgSize, array( 'class' => 'img-responsive' ) ); ?>
				</a>
				<div class="date">
					<span class="day heading-font"><?php echo esc_html( $dateParse[0] ); ?></span>
					<span class="month heading-font"><?php echo esc_html( $dateParse[1] ); ?></span>
				</div>
			</div>
			<h4><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>

<?php else : ?>

	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="post-grid-single-unit
		<?php
		if ( is_sticky( get_the_ID() ) ) {
			echo 'sticky-wrap'; }
		?>
		">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="image">
					<a href="<?php the_permalink(); ?>">
						<!--Video Format-->
						<?php if ( get_post_format( get_the_ID() ) === 'video' ) : ?>
							<div class="video-preview">
								<i class="fas fa-film"></i><?php esc_html_e( 'Video', 'motors-elementor-widgets' ); ?>
							</div>
						<?php endif; ?>
						<!--Sticky Post-->
						<?php if ( is_sticky( get_the_ID() ) ) : ?>
							<div class="sticky-post heading-font"><?php esc_html_e( 'Sticky Post', 'motors-elementor-widgets' ); ?></div>
						<?php endif; ?>
						<?php the_post_thumbnail( $imgSize, array( 'class' => 'img-responsive' ) ); ?>
					</a>
				</div>
			<?php else : ?>
				<?php if ( is_sticky( get_the_ID() ) ) : ?>
					<div class="sticky-post blog-post-no-image heading-font"><?php esc_html_e( 'Sticky', 'motors-elementor-widgets' ); ?></div>
				<?php endif; ?>
			<?php endif; ?>
			<div class="content">
				<div class="title-relative">
					<a href="<?php the_permalink(); ?>">
						<?php $title = stm_trim_title( 85, '...' ); ?>
						<?php if ( ! empty( $title ) ) : ?>
							<h4 class="title"><?php echo esc_attr( $title ); ?></h4>
						<?php endif; ?>
					</a>
				</div>
				<?php if ( $blog_show_excerpt ) : ?>
					<div class="blog-posts-excerpt">
						<?php the_excerpt(); ?>
						<div>
							<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue reading', 'motors-elementor-widgets' ); ?></a>
						</div>
					</div>
				<?php endif; ?>
				<div class="post-meta-bottom">
					<div class="blog-meta-unit">
						<i class="stm-icon-date"></i>
						<span><?php echo get_the_date(); ?></span>
					</div>
					<div class="blog-meta-unit comments">
						<a href="<?php comments_link(); ?>" class="post_comments">
							<i class="stm-icon-message"></i> <?php comments_number(); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
endif;
