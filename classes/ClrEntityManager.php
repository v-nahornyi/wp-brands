<?php

namespace Clr;

use Clr\PostType\ClrNews;
use Clr\PostType\ClrOnlineRetailer;
use Clr\PostType\ClrProDistributors;
use Clr\PostType\ClrProduct;
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
		ClrProDistributors::setup();
		ClrNews::setup();
	}
}