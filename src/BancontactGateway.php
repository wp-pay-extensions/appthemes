<?php

/**
 * Title: AppThemes Bancontact Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version 1.0.5
 * @since 1.0.3
 */
class Pronamic_WP_Pay_Extensions_AppThemes_BancontactGateway extends Pronamic_WP_Pay_Extensions_AppThemes_Gateway {
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
		$this->payment_method = Pronamic_WP_Pay_PaymentMethods::BANCONTACT;

		parent::__construct( array(
			'dropdown'  => __( 'Bancontact', 'pronamic_ideal' ),
			'admin'     => __( 'Bancontact', 'pronamic_ideal' ),
			'recurring' => false,
		) );
	}
}
