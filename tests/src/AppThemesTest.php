<?php

namespace Pronamic\WordPress\Pay\Extensions\AppThemes\Tests;

use PHPUnit_Framework_TestCase;

/**
 * Title: WordPress pay AppThemes test
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.0.0
 * @since   2.0.0
 */
class AppThemesTest extends PHPUnit_Framework_TestCase {
	/**
	 * Test class.
	 */
	public function test_class() {
		$this->assertTrue( class_exists( 'Pronamic\WordPress\Pay\Extensions\AppThemes\AppThemes' ) );
	}
}
