<?php
use Pronamic\WordPress\Pay\Payments\PaymentData;

/**
 * Title: WordPress AppThemes payment data
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.2
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Extensions_AppThemes_PaymentData extends PaymentData {
	/**
	 * AppThemes order
	 *
	 * @var APP_Order_Receipt
	 */
	private $order;

	//////////////////////////////////////////////////

	/**
	 * Constructs and intializes an AppThems payment data object
	 */
	public function __construct( $order ) {
		parent::__construct();

		$this->order = $order;
	}

	//////////////////////////////////////////////////

	/**
	 * Get source indicator
	 *
	 * @see Pronamic_Pay_PaymentDataInterface::get_source()
	 * @return string
	 */
	public function get_source() {
		return 'appthemes';
	}

	//////////////////////////////////////////////////

	/**
	 * Get description
	 *
	 * @see Pronamic_Pay_PaymentDataInterface::get_description()
	 * @return string
	 */
	public function get_description() {
		return $this->order->get_description();
	}

	/**
	 * Get order ID
	 *
	 * @see Pronamic_Pay_PaymentDataInterface::get_order_id()
	 * @return string
	 */
	public function get_order_id() {
		return $this->order->get_id();
	}

	/**
	 * Get items
	 *
	 * @see Pronamic_Pay_PaymentDataInterface::get_items()
	 * @return Pronamic_IDeal_Items
	 */
	public function get_items() {
		// Items
		$items = new Pronamic_IDeal_Items();

		// Item
		$item = new Pronamic_IDeal_Item();
		$item->setNumber( $this->get_order_id() );
		$item->setDescription( $this->get_description() );
		$item->setPrice( $this->order->get_total() );
		$item->setQuantity( 1 );

		$items->addItem( $item );

		return $items;
	}

	//////////////////////////////////////////////////
	// Currency
	//////////////////////////////////////////////////

	/**
	 * Get currency alphabetic code
	 *
	 * @see Pronamic_Pay_PaymentDataInterface::get_currency_alphabetic_code()
	 * @return string
	 */
	public function get_currency_alphabetic_code() {
		return $this->order->get_currency();
	}

	//////////////////////////////////////////////////
	// Customer
	//////////////////////////////////////////////////

	public function get_email() {
		$author_id = $this->order->get_author();

		return get_the_author_meta( 'user_email', $author_id );
	}

	public function get_customer_name() {
		$author_id = $this->order->get_author();

		return get_the_author_meta( 'first_name', $author_id ) . ' ' . get_the_author_meta( 'last_name', $author_id );
	}

	public function get_address() {
		return '';
	}

	public function get_city() {
		return '';
	}

	public function get_zip() {
		return '';
	}

	//////////////////////////////////////////////////
	// URL's
	// @todo we could also use $this->merchant->cart_data['transaction_results_url']
	// @see http://plugins.trac.wordpress.org/browser/wp-e-commerce/tags/3.8.8.3/wpsc-includes/merchant.class.php#L184
	//////////////////////////////////////////////////

	public function get_normal_return_url() {
		return $this->order->get_return_url();
	}

	public function get_cancel_url() {
		return $this->order->get_cancel_url();
	}

	public function get_success_url() {
		return $this->order->get_return_url();
	}

	public function get_error_url() {
		return $this->order->get_return_url();
	}
}
