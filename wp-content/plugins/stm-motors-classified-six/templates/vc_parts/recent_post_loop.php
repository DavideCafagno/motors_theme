<?php
$date = get_the_date('d - M');
$dateParse = explode(' - ', $date);
?>
<div class="recent-post-item">
	<div class="img">
        <a href="<?php echo esc_url(get_the_permalink());?>">
		    <?php the_post_thumbnail('full'); ?>
        </a>
		<div class="date">
			<span class="day heading-font"><?php echo esc_html($dateParse[0]);?></span>
            <span class="month heading-font"><?php echo esc_html($dateParse[1]);?></span>
		</div>
	</div>
    <h4><a href="<?php echo esc_url(get_the_permalink());?>"><?php the_title(); ?></a></h4>
	<div class="excerpt">
		<?php the_excerpt(); ?>
	</div>
</div>
