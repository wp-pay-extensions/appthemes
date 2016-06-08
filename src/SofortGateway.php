<?php

/**
 * Title: AppThemes SOFORT Banking Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version 1.0.3
 * @since 1.0.3
 */
class Pronamic_WP_Pay_Extensions_AppThemes_SofortGateway extends Pronamic_WP_Pay_Extensions_AppThemes_Gateway {
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
		$this->payment_method = Pronamic_WP_Pay_PaymentMethods::SOFORT;

		parent::__construct( array(
			'dropdown'  => __( 'SOFORT Banking', 'pronamic_ideal' ),
			'admin'     => __( 'SOFORT Banking', 'pronamic_ideal' ),
			'recurring' => false,
		) );
	}
}
