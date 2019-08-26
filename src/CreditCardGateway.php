<?php

namespace Pronamic\WordPress\Pay\Extensions\AppThemes;

use Pronamic\WordPress\Pay\Core\PaymentMethods;

/**
 * Title: AppThemes Credit Card Gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.0.0
 * @since   1.0.3
 */
class CreditCardGateway extends Gateway {
	/**
	 * The unique ID of this Credit Card payment gateway.
	 *
	 * @var string
	 */
	const ID = 'pronamic_pay_credit_card';

	/**
	 * Constructs and initialize the Credit Card gateway for AppThemes
	 */
	public function __construct() {
		$this->id             = self::ID;
		$this->payment_method = PaymentMethods::CREDIT_CARD;

		parent::__construct(
			array(
				'dropdown'  => __( 'Credit Card', 'pronamic_ideal' ),
				'admin'     => __( 'Credit Card', 'pronamic_ideal' ),
				'recurring' => false,
			)
		);
	}
}
