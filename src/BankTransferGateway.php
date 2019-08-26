<?php

namespace Pronamic\WordPress\Pay\Extensions\AppThemes;

use Pronamic\WordPress\Pay\Core\PaymentMethods;

/**
 * Title: AppThemes Bank Transfer Gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.0.0
 * @since   1.0.3
 */
class BankTransferGateway extends Gateway {
	/**
	 * The unique ID of this Bank Transfer payment gateway.
	 *
	 * @var string
	 */
	const ID = 'pronamic_pay_bank_transfer';

	/**
	 * Constructs and initialize the Bank Transfer gateway for AppThemes.
	 */
	public function __construct() {
		$this->id             = self::ID;
		$this->payment_method = PaymentMethods::BANK_TRANSFER;

		parent::__construct(
			array(
				'dropdown'  => __( 'Bank Transfer', 'pronamic_ideal' ),
				'admin'     => __( 'Bank Transfer', 'pronamic_ideal' ),
				'recurring' => false,
			)
		);
	}
}
