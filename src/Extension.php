<?php

/**
 * Title: AppThemes iDEAL Add-On
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.4
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Extensions_AppThemes_Extension {
	/**
	 * Slug
	 *
	 * @var string
	 */
	const SLUG = 'appthemes';

	//////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public static function bootstrap() {
		add_action( 'init', array( __CLASS__, 'load_gateway' ), 100 );

		add_action( 'template_redirect', array( __CLASS__, 'maybe_process_the_order' ) );
	}

	//////////////////////////////////////////////////

	/**
	 * Initialize
	 */
	public static function load_gateway() {
		if ( function_exists( 'appthemes_register_gateway' ) ) {
			appthemes_register_gateway( 'Pronamic_WP_Pay_Extensions_AppThemes_Gateway' );
			appthemes_register_gateway( 'Pronamic_WP_Pay_Extensions_AppThemes_BancontactGateway' );
			appthemes_register_gateway( 'Pronamic_WP_Pay_Extensions_AppThemes_BankTransferGateway' );
			appthemes_register_gateway( 'Pronamic_WP_Pay_Extensions_AppThemes_CreditCardGateway' );
			appthemes_register_gateway( 'Pronamic_WP_Pay_Extensions_AppThemes_DirectDebitGateway' );
			appthemes_register_gateway( 'Pronamic_WP_Pay_Extensions_AppThemes_IDealGateway' );
			appthemes_register_gateway( 'Pronamic_WP_Pay_Extensions_AppThemes_SofortGateway' );

			add_action( 'pronamic_payment_status_update_' . self::SLUG, array( __CLASS__, 'status_update' ), 10, 2 );
			add_filter( 'pronamic_payment_source_text_' . self::SLUG,   array( __CLASS__, 'source_text' ), 10, 2 );
		}
	}

	/**
	 * Maybe redirect
	 */
	public static function maybe_process_the_order() {
		$gateways = array(
			'appthemes_pronamic_ideal',
			'appthemes_pronamic_pay',
			'appthemes_pronamic_pay_bancontact',
			'appthemes_pronamic_pay_bank_transfer',
			'appthemes_pronamic_pay_credit_card',
			'appthemes_pronamic_pay_direct_debit',
			'appthemes_pronamic_pay_sofort',
		);

		foreach ( $gateways as $gateway ) {
			if ( filter_has_var( INPUT_POST, $gateway ) ) {
				process_the_order();

				break;
			}
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Update lead status of the specified payment
	 *
	 * @param string $payment
	 */
	public static function status_update( Pronamic_Pay_Payment $payment, $can_redirect = false ) {
		if ( self::SLUG === $payment->get_source() ) {
			$id = $payment->get_source_id();

			$order = appthemes_get_order( $id );

			$data = new Pronamic_WP_Pay_Extensions_AppThemes_PaymentData( $order );

			$url = $data->get_normal_return_url();

			switch ( $payment->status ) {
				case Pronamic_WP_Pay_Statuses::CANCELLED:
					$order->failed();

					$url = $data->get_cancel_url();

					break;
				case Pronamic_WP_Pay_Statuses::EXPIRED:
					$order->failed();

					$url = $data->get_error_url();

					break;
				case Pronamic_WP_Pay_Statuses::FAILURE:
					$order->failed();

					$url = $data->get_error_url();

					break;
				case Pronamic_WP_Pay_Statuses::SUCCESS:
					$order->complete();

					$url = $data->get_success_url();

					break;
				case Pronamic_WP_Pay_Statuses::OPEN:
					$order->pending();

					break;
				default:
					$order->pending();

					break;
			}

			if ( $can_redirect ) {
				wp_redirect( $url );

				exit;
			}
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Source column
	 */
	public static function source_text( $text, Pronamic_Pay_Payment $payment ) {
		$text  = '';

		$text .= __( 'AppThemes', 'pronamic_ideal' ) . '<br />';

		$text .= sprintf( '<a href="%s">%s</a>',
			get_edit_post_link( $payment->get_source_id() ),
			sprintf( __( 'Order #%s', 'pronamic_ideal' ), $payment->get_source_id() )
		);

		return $text;
	}
}
