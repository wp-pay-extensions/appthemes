<?php
use Pronamic\WordPress\Pay\Core\PaymentMethods;

/**
 * Title: AppThemes iDEAL Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.3
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Extensions_AppThemes_IDealGateway extends Pronamic_WP_Pay_Extensions_AppThemes_Gateway {
	/**
	 * The unique ID of this iDEAL payment gateway.
	 *
	 * @var string
	 */
	const ID = 'pronamic_ideal';

	/**
	 * Constructs and initialize the iDEAL gateway for AppThemes.
	 */
	public function __construct() {
		$this->id             = self::ID;
		$this->payment_method = PaymentMethods::IDEAL;

		parent::__construct( array(
			'dropdown'  => __( 'iDEAL', 'pronamic_ideal' ),
			'admin'     => __( 'iDEAL', 'pronamic_ideal' ),
			'recurring' => false,
		) );
	}
}
