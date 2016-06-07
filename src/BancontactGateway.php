<?php

/**
 * Title: AppThemes Bancontact Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Reüel van der Steege
 * @version unreleased
 * @since unreleased
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
		$this->payment_method = Pronamic_WP_Pay_PaymentMethods::MISTER_CASH;

		parent::__construct( array(
			'dropdown'  => __( 'Bancontact/Mister Cash', 'pronamic_ideal' ),
			'admin'     => __( 'Bancontact/Mister Cash', 'pronamic_ideal' ),
			'recurring' => false,
		) );
	}
}
