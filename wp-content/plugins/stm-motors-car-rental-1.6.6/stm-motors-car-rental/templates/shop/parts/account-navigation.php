<div class="title-wrap">
    <h2><?php the_title(); ?></h2>
</div>
<div class="stm-mcr-account-navigation-wrap">
	<div class="breadcrumbs-wrap"><?php woocommerce_breadcrumb();?></div>
    <div class="nav-wrap">
		<?php do_action( 'woocommerce_account_navigation' ); ?>
    </div>
</div>