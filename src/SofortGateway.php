<?php

namespace Pronamic\WordPress\Pay\Extensions\AppThemes;

use Pronamic\WordPress\Pay\Core\PaymentMethods;

/**
 * Title: AppThemes SOFORT Banking Gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.0.0
 * @since   1.0.3
 */
class SofortGateway extends Gateway {
	/**
	 * The unique ID of this SOFORT Banking payment gateway.
	 *
	 * @var string
	 */
	const ID = 'pronamic_pay_sofort';

	/**
	 * Constructs and initialize the SOFORT Banking gateway for AppThemes
	 */
	public function __construct() {
		$this->id             = self::ID;
		$this->payment_method = PaymentMethods::SOFORT;

		parent::__construct(
			array(
				'dropdown'  => __( 'SOFORT Banking', 'pronamic_ideal' ),
				'admin'     => __( 'SOFORT Banking', 'pronamic_ideal' ),
				'recurring' => false,
			)
		);
	}
}
