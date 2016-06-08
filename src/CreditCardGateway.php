<?php

/**
 * Title: AppThemes Credit Card Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version 1.0.3
 * @since 1.0.3
 */
class Pronamic_WP_Pay_Extensions_AppThemes_CreditCardGateway extends Pronamic_WP_Pay_Extensions_AppThemes_Gateway {
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
		$this->payment_method = Pronamic_WP_Pay_PaymentMethods::CREDIT_CARD;

		parent::__construct( array(
			'dropdown'  => __( 'Credit Card', 'pronamic_ideal' ),
			'admin'     => __( 'Credit Card', 'pronamic_ideal' ),
			'recurring' => false,
		) );
	}
}
