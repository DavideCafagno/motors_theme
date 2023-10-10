<?php

namespace Motors_E_W\Widgets\WidgetManager;

use Motors_E_W\Widgets\HeroBanner;
use Motors_E_W\Widgets\HeroSlider;
use Motors_E_W\Widgets\AddListing;
use Motors_E_W\Widgets\DealersList;
use Motors_E_W\Widgets\ListingsCompare;
use Motors_E_W\Widgets\ImageCategories;
use Motors_E_W\Widgets\ListingSearchTabs;
use Motors_E_W\Widgets\LoginRegister;
use Motors_E_W\Widgets\MegaMenu\TopCategories;
use Motors_E_W\Widgets\MegaMenu\TopMakesTabs;
use Motors_E_W\Widgets\MegaMenu\TopVehicles;
use Motors_E_W\Widgets\PostsGrid;
use Motors_E_W\Widgets\PricingPlan;
use Motors_E_W\Widgets\PlayVideo;
use Motors_E_W\Widgets\SingleListing\Actions;
use Motors_E_W\Widgets\SingleListing\CarGuru;
use Motors_E_W\Widgets\SingleListing\CarMPG;
use Motors_E_W\Widgets\SingleListing\ContactInfo;
use Motors_E_W\Widgets\SingleListing\DealerEmail;
use Motors_E_W\Widgets\SingleListing\DealerPhoneNumber;
use Motors_E_W\Widgets\SingleListing\Features;
use Motors_E_W\Widgets\SingleListing\Gallery;
use Motors_E_W\Widgets\SingleListing\ListingData;
use Motors_E_W\Widgets\SingleListing\Classified\ListingData as ListingDataClassified;
use Motors_E_W\Widgets\SingleListing\ListingMap;
use Motors_E_W\Widgets\SingleListing\ListingSpecifications;
use Motors_E_W\Widgets\SingleListing\OfferPriceButton;
use Motors_E_W\Widgets\SingleListing\Price;
use Motors_E_W\Widgets\SingleListing\Classified\Price as PriceClassified;
use Motors_E_W\Widgets\SingleListing\SearchResults;
use Motors_E_W\Widgets\SingleListing\ListingDescription;
use Motors_E_W\Widgets\SingleListing\Similar;
use Motors_E_W\Widgets\SingleListing\Title;
use Motors_E_W\Widgets\SingleListing\Classified\Title as TitleClassified;
use Motors_E_W\Widgets\SingleListing\TradeInButton;
use Motors_E_W\Widgets\SingleListing\Classified\UserDataAdvanced;
use Motors_E_W\Widgets\SingleListing\Classified\UserDataSimple;
use Motors_E_W\Widgets\SingleListing\WhatsApp;
use Motors_E_W\Widgets\Info;
use Motors_E_W\Widgets\CarListingTabs;
use Motors_E_W\Widgets\LoanCalculator;
use Motors_E_W\Widgets\ContactTabs;
use Motors_E_W\Widgets\ListingsCarousel;
use Motors_E_W\Widgets\ListingsGrid;
use Motors_E_W\Widgets\ListingsGridTabs;
use Motors_E_W\Widgets\ListingsList;
use Motors_E_W\Widgets\ListingsCategoriesMasonry;
use Motors_E_W\Widgets\InventorySearchFilter;
use Motors_E_W\Widgets\InventorySearchResults;
use Motors_E_W\Widgets\InventorySortBy;
use Motors_E_W\Widgets\InventoryViewType;
use Motors_E_W\Widgets\ImageCarousel;
use Motors_E_W\Widgets\TestimonialsCarousel;
use Motors_E_W\Widgets\ArrowBanner;
use Motors_E_W\Widgets\SellYourCar;
use Motors_E_W\Widgets\MultiListing\MultiListingSearchTabs;
use Motors_E_W\Widgets\MultiListing\MultiListingsGridTabs;
use Motors_E_W\Widgets\MultiListing\MultiListingAddItemButtons;
use STM_E_W\Helpers\Helper;


class MotorsWidgetsManager {

	private static $instance = array();

	protected function __construct() {
	}

	protected function __clone() {
	}

	public static function getInstance() {
		$cls = static::class;
		if ( ! isset( self::$instance[ $cls ] ) ) {
			self::$instance[ $cls ] = new static();
		}

		return self::$instance[ $cls ];
	}

	public function stm_ew_get_all_registered_widgets() {
		$widgets = array(
			HeroBanner::class,
			HeroSlider::class,
			LoanCalculator::class,
			CarListingTabs::class,
			ContactInfo::class,
			ListingsCompare::class,
			ListingsCarousel::class,
			ListingsGrid::class,
			ListingsGridTabs::class,
			ListingSearchTabs::class,
			ListingsList::class,
			ListingsCategoriesMasonry::class,
			InventorySearchResults::class,
			InventorySearchFilter::class,
			InventorySortBy::class,
			InventoryViewType::class,
			ImageCarousel::class,
			TestimonialsCarousel::class,
			Actions::class,
			CarGuru::class,
			CarMPG::class,
			DealerEmail::class,
			DealerPhoneNumber::class,
			Features::class,
			Gallery::class,
			ListingData::class,
			ListingDataClassified::class,
			ListingSpecifications::class,
			Info::class,
			Price::class,
			PriceClassified::class,
			SearchResults::class,
			ListingDescription::class,
			Similar::class,
			ContactTabs::class,
			Title::class,
			TitleClassified::class,
			OfferPriceButton::class,
			TradeInButton::class,
			WhatsApp::class,
			ArrowBanner::class,
			ImageCategories::class,
			PostsGrid::class,
			ListingMap::class,
			PlayVideo::class,
			SellYourCar::class,
		);

		if ( 'listing_one_elementor' === Helper::stm_ew_get_selected_layout() || 'listing_four_elementor' === Helper::stm_ew_get_selected_layout() || 'car_dealer_two_elementor' === Helper::stm_ew_get_selected_layout() || 'listing_three_elementor' === Helper::stm_ew_get_selected_layout() || 'listing_five_elementor' === Helper::stm_ew_get_selected_layout() ) {
			$widgets = array_merge(
				array(
					AddListing::class,
					UserDataAdvanced::class,
					UserDataSimple::class,
					PricingPlan::class,
					DealersList::class,
					LoginRegister::class,
				),
				$widgets
			);
		}

		if ( Helper::is_multilisting_active() ) {
			$widgets = array_merge(
				array(
					MultiListingSearchTabs::class,
					MultiListingsGridTabs::class,
					MultiListingAddItemButtons::class,
				),
				$widgets
			);
		}

		if ( Helper::is_megamenu_active() ) {
			$widgets = array_merge(
				array(
					TopMakesTabs::class,
					TopCategories::class,
					TopVehicles::class,
				),
				$widgets
			);
		}

		return $widgets;
	}
}
