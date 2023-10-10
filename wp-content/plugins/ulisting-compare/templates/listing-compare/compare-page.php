<?php if($listing_types):?>
	<ul class="nav nav-pills">
		<?php $i = 0; foreach ($listing_types as $listing_type):?>
			<?php
			$active = "";
			if( ($i == 0 AND !$listing_type_id) OR ($listing_type_id == $listing_type->ID))
				$active = "active";
			?>
			<li class="nav-item">
				<a class="nav-link <?php echo esc_html($active)?>" href="<?php echo esc_url($page_url."?listing_type_id=".$listing_type->ID)?>">
					<?php echo esc_html($listing_type->post_title)?>
					<span  class="badge badge-dark "><?php echo esc_attr($listing_type->lisitng_total_count) ?></span>
				</a>
			</li>
			<?php $i++; endforeach;?>
	</ul>
	<?php if(!empty($listing_type_attributes)): ?>
		<table class="table">
			<thead>
			<tr>
				<th scope="col"><?php _e("Attribute")?></th>
				<?php foreach ($listings as $listing):?>
					<th scope="col">
						<?php echo esc_html($listing->post_title)?>
						<a href="#" onclick="remove_listing_compare(<?php echo esc_attr($listing->ID)?>)"><?php _e("Remove", "ulisting")?></a>
					</th>
				<?php endforeach;?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($listing_type_attributes as $listing_type_attribute):?>
				<tr>
					<th scope="row"><?php echo esc_html($listing_type_attribute->title)?></th>
					<?php foreach ($listings as $listing):?>
						<td>
							<?php echo \uListing\ListingCompare\Classes\UlistingListingCompare::render_attribute_value($listing, $listing_type_attribute);?>
						</td>
					<?php endforeach;?>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php else:?>
	<h3 class="text-center"><?php _e("Empty")?></h3>
<?php endif;?>



