<?php

namespace Pronamic\WordPress\Pay\Extensions\AppThemes;

use Pronamic\WordPress\Pay\Core\PaymentMethods;

/**
 * Title: AppThemes Direct Debit Gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.0.0
 * @since   1.0.3
 */
class DirectDebitGateway extends Gateway {
	/**
	 * The unique ID of this Direct Debit payment gateway
	 *
	 * @var string
	 */
	const ID = 'pronamic_pay_direct_debit';

	/**
	 * Constructs and initialize the Direct Debit gateway for AppThemes
	 */
	public function __construct() {
		$this->id             = self::ID;
		$this->payment_method = PaymentMethods::DIRECT_DEBIT;

		parent::__construct(
			array(
				'dropdown'  => __( 'Direct Debit', 'pronamic_ideal' ),
				'admin'     => __( 'Direct Debit', 'pronamic_ideal' ),
				'recurring' => false,
			)
		);
	}
}
