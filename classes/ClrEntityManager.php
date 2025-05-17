<?php

namespace Clr;

use Clr\PostType\ClrLocation;
use Clr\PostType\ClrNews;
use Clr\PostType\ClrOnlineRetailer;
use Clr\PostType\ClrProDistributor;
use Clr\PostType\ClrProduct;
use Clr\PostType\ClrRetailer;
use Clr\ProlineDistributor\ClrProlineDistributor;

class ClrEntityManager {

	public static function init(): void {
		self::setup_post_types();
		self::setup_users();
	}

	private static function setup_post_types(): void {
		ClrProduct::setup();
		ClrOnlineRetailer::setup();
		ClrProDistributor::setup();
		ClrRetailer::setup();
		ClrLocation::setup();
		ClrNews::setup();
	}

	private static function setup_users() {
		ClrProlineDistributor::setup();
	}
}