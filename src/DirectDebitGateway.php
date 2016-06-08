<?php

/**
 * Title: AppThemes Direct Debit Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version 1.0.3
 * @since 1.0.3
 */
class Pronamic_WP_Pay_Extensions_AppThemes_DirectDebitGateway extends Pronamic_WP_Pay_Extensions_AppThemes_Gateway {
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
		$this->payment_method = Pronamic_WP_Pay_PaymentMethods::DIRECT_DEBIT;

		parent::__construct( array(
			'dropdown'  => __( 'Direct Debit', 'pronamic_ideal' ),
			'admin'     => __( 'Direct Debit', 'pronamic_ideal' ),
			'recurring' => false,
		) );
	}
}
