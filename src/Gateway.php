<?php

/**
 * Title: AppThemes Pronamic Gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.3
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Extensions_AppThemes_Gateway extends APP_Gateway {
	/**
	 * The unique ID of this payment gateway.
	 *
	 * @var string
	 */
	const ID = 'pronamic_pay';

	/**
	 * The payment method.
	 *
	 * @var string
	 */
	protected $payment_method;

	/**
	 * Constructs and initialize the gateway for AppThemes.
	 */
	public function __construct( $args = array() ) {
		if ( empty( $args ) ) {
			$this->id = self::ID;

			$args = array(
				'dropdown'  => __( 'Pronamic', 'pronamic_ideal' ),
				'admin'     => __( 'Pronamic', 'pronamic_ideal' ),
				'recurring' => false,
			);
		}

		parent::__construct( $this->id, $args );
	}

	//////////////////////////////////////////////////

	/**
	 * Returns an array representing the form to output for admin config.
	 */
	public function form() {
		$form_values = array(
			array(
				'title'   => __( 'Configuration', 'pronamic_ideal' ),
				'type'    => 'select',
				'name'    => 'config_id',
				'choices' => Pronamic_WP_Pay_Plugin::get_config_select_options( $this->payment_method ),
			),
		);

		$return_array = array(
			'title'   => __( 'General Information', 'pronamic_ideal' ),
			'fields'  => $form_values,
		);

		return $return_array;
	}

	//////////////////////////////////////////////////

	/**
	 * Processes a payment using this gateway.
	 */
	public function process( $order, $options ) {
		if ( isset( $options['config_id'] ) ) {
			$config_id = $options['config_id'];

			$gateway = Pronamic_WP_Pay_Plugin::get_gateway( $config_id );

			if ( $gateway ) {
				if ( null === $this->payment_method && $gateway->payment_method_is_required() ) {
					$this->payment_method = Pronamic_WP_Pay_PaymentMethods::IDEAL;
				}

				$data = new Pronamic_WP_Pay_Extensions_AppThemes_PaymentData( $order );

				if ( filter_has_var( INPUT_POST, 'appthemes_' . $this->id ) ) {
					$payment = Pronamic_WP_Pay_Plugin::start( $config_id, $gateway, $data, $this->payment_method );

					$error = $gateway->get_error();

					if ( is_wp_error( $error ) ) {
						foreach ( $error->get_error_messages() as $message ) {
							echo $message;
						}
					} else {
						$gateway->redirect( $payment );
					}
				} else {
					?>
					<form method="post" action="">
						<?php $gateway->set_payment_method( $this->payment_method ); ?>

						<?php echo $gateway->get_input_html(); ?>

						<p>
							<?php

							printf(
								'<input class="ideal-button" type="submit" name="appthemes_%s" value="%s" />',
								esc_attr( $this->id ),
								__( 'Pay', 'pronamic_ideal' )
							);

							?>
						</p>
					</form>
					<?php
				}
			}
		}
	}
}
