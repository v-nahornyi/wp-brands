<?php

namespace Wpb;

use Wpb\PostType\WpbFaq;
use Wpb\PostType\WpbLocation;
use Wpb\PostType\WpbNews;
use Wpb\PostType\WpbOnlineRetailer;
use Wpb\PostType\WpbProDistributor;
use Wpb\PostType\WpbProduct;
use Wpb\PostType\WpbRetailer;
use Wpb\ProlineDistributor\WpbProlineDistributor;

class WpbEntityManager {

	public static function init(): void {
		self::setup_post_types();
		self::setup_users();
	}

	private static function setup_post_types(): void {
		WpbProduct::setup();
		WpbOnlineRetailer::setup();
		WpbProDistributor::setup();
		WpbRetailer::setup();
		WpbLocation::setup();
		WpbNews::setup();
		WpbFaq::setup();
	}

	private static function setup_users() {
		WpbProlineDistributor::setup();
	}
}