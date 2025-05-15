<?php

namespace Clr;

use Clr\PostType\ClrLocation;
use Clr\PostType\ClrNews;
use Clr\PostType\ClrOnlineRetailer;
use Clr\PostType\ClrProDistributor;
use Clr\PostType\ClrProduct;
use Clr\PostType\ClrRetailer;
use Clr\Taxonomy\ClrAvailableSize;
use Clr\Taxonomy\ClrIngredient;

class ClrEntityManager {

	public static function init() {
		self::setup_post_types();
	}

	public static function setup_post_types() {
		ClrProduct::setup();
		ClrIngredient::setup();
		ClrAvailableSize::setup();
		ClrOnlineRetailer::setup();
		ClrProDistributor::setup();
		ClrRetailer::setup();
		ClrLocation::setup();
		ClrNews::setup();
	}
}