<?php

namespace Pronamic\WordPress\Pay\Extensions\AppThemes;

use Pronamic\WordPress\Pay\Core\Statuses;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: AppThemes iDEAL Add-On
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Extension {
	/**
	 * Slug
	 *
	 * @var string
	 */
	const SLUG = 'appthemes';

	/**
	 * Bootstrap
	 */
	public static function bootstrap() {
		add_action( 'init', array( __CLASS__, 'load_gateway' ), 100 );

		add_action( 'template_redirect', array( __CLASS__, 'maybe_process_the_order' ) );
	}

	/**
	 * Initialize
	 */
	public static function load_gateway() {
		if ( ! function_exists( 'appthemes_register_gateway' ) ) {
			return;
		}

		appthemes_register_gateway( 'Pronamic\WordPress\Pay\Extensions\AppThemes\Gateway' );
		appthemes_register_gateway( 'Pronamic\WordPress\Pay\Extensions\AppThemes\BancontactGateway' );
		appthemes_register_gateway( 'Pronamic\WordPress\Pay\Extensions\AppThemes\BankTransferGateway' );
		appthemes_register_gateway( 'Pronamic\WordPress\Pay\Extensions\AppThemes\CreditCardGateway' );
		appthemes_register_gateway( 'Pronamic\WordPress\Pay\Extensions\AppThemes\DirectDebitGateway' );
		appthemes_register_gateway( 'Pronamic\WordPress\Pay\Extensions\AppThemes\IDealGateway' );
		appthemes_register_gateway( 'Pronamic\WordPress\Pay\Extensions\AppThemes\SofortGateway' );

		add_action( 'pronamic_payment_status_update_' . self::SLUG, array( __CLASS__, 'status_update' ), 10, 2 );
		add_filter( 'pronamic_payment_source_text_' . self::SLUG, array( __CLASS__, 'source_text' ), 10, 2 );
		add_filter( 'pronamic_payment_source_description_' . self::SLUG, array( __CLASS__, 'source_description' ), 10, 2 );
		add_filter( 'pronamic_payment_source_url_' . self::SLUG, array( __CLASS__, 'source_url' ), 10, 2 );
	}

	/**
	 * Maybe redirect
	 */
	public static function maybe_process_the_order() {
		if ( ! function_exists( 'process_the_order' ) ) {
			return;
		}

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
			if ( ! filter_has_var( INPUT_POST, $gateway ) ) {
				continue;
			}

			process_the_order();

			break;
		}
	}

	/**
	 * Update lead status of the specified payment
	 *
	 * @param Payment $payment      Payment.
	 * @param bool    $can_redirect Whether or not to redirect.
	 */
	public static function status_update( Payment $payment, $can_redirect = false ) {
		if ( self::SLUG !== $payment->get_source() ) {
			return;
		}

		$id = $payment->get_source_id();

		$order = appthemes_get_order( $id );

		$data = new PaymentData( $order );

		$url = $data->get_normal_return_url();

		switch ( $payment->status ) {
			case Statuses::CANCELLED:
				$order->failed();

				$url = $data->get_cancel_url();

				break;
			case Statuses::EXPIRED:
				$order->failed();

				$url = $data->get_error_url();

				break;
			case Statuses::FAILURE:
				$order->failed();

				$url = $data->get_error_url();

				break;
			case Statuses::SUCCESS:
				$order->complete();

				$url = $data->get_success_url();

				break;
			case Statuses::OPEN:
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

	/**
	 * Source column
	 *
	 * @param string  $text    Source text.
	 * @param Payment $payment Payment to get source text for.
	 *
	 * @return string
	 */
	public static function source_text( $text, Payment $payment ) {
		$text = __( 'AppThemes', 'pronamic_ideal' ) . '<br />';

		$text .= sprintf(
			'<a href="%s">%s</a>',
			get_edit_post_link( $payment->get_source_id() ),
			/* translators: %s: payment source id */
			sprintf( __( 'Order #%s', 'pronamic_ideal' ), $payment->get_source_id() )
		);

		return $text;
	}

	/**
	 * Source description.
	 *
	 * @param string  $description Source description.
	 * @param Payment $payment     Payment to get source description for.
	 *
	 * @return string
	 */
	public static function source_description( $description, Payment $payment ) {
		return __( 'AppThemes Order', 'pronamic_ideal' );
	}

	/**
	 * Source URL.
	 *
	 * @param string  $url     Source URL.
	 * @param Payment $payment Payment to get source URL for.
	 *
	 * @return string|null
	 */
	public static function source_url( $url, Payment $payment ) {
		return get_edit_post_link( $payment->get_source_id() );
	}
}
