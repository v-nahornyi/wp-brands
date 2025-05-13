<?php

namespace Clr;

use Clr\PostType\ClrAvailableSize;
use Clr\PostType\ClrOnlineRetailer;
use Clr\PostType\ClrProduct;
use Clr\PostType\ClrIngredient;
use Clr\PostType\ClrNews;

class ClrEntityManager {

	public static function init() {
		self::setup_post_types();
	}

	public static function setup_post_types() {
		ClrProduct::setup();
		ClrIngredient::setup();
		ClrAvailableSize::setup();
		ClrOnlineRetailer::setup();
		ClrNews::setup();
	}
}