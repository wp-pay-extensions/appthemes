<?php

namespace Pronamic\WordPress\Pay\Extensions\AppThemes;

use Pronamic\WordPress\Pay\Core\PaymentMethods;

/**
 * Title: AppThemes Bancontact Gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.0.0
 * @since   1.0.3
 */
class BancontactGateway extends Gateway {
	/**
	 * The unique ID of this Bancontact payment gateway.
	 *
	 * @var string
	 */
	const ID = 'pronamic_pay_bancontact';

	/**
	 * Constructs and initialize the Bancontact gateway for AppThemes.
	 */
	public function __construct() {
		$this->id             = self::ID;
		$this->payment_method = PaymentMethods::BANCONTACT;

		parent::__construct(
			array(
				'dropdown'  => __( 'Bancontact', 'pronamic_ideal' ),
				'admin'     => __( 'Bancontact', 'pronamic_ideal' ),
				'recurring' => false,
			)
		);
	}
}
