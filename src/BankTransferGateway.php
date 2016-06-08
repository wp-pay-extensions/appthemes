<?php

/**
 * Title: AppThemes Bank Transfer Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version 1.0.3
 * @since 1.0.3
 */
class Pronamic_WP_Pay_Extensions_AppThemes_BankTransferGateway extends Pronamic_WP_Pay_Extensions_AppThemes_Gateway {
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
		$this->payment_method = Pronamic_WP_Pay_PaymentMethods::BANK_TRANSFER;

		parent::__construct( array(
			'dropdown'  => __( 'Bank Transfer', 'pronamic_ideal' ),
			'admin'     => __( 'Bank Transfer', 'pronamic_ideal' ),
			'recurring' => false,
		) );
	}
}
