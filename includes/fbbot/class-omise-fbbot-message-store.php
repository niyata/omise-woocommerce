<?php
defined( 'ABSPATH' ) or die( "No direct script access allowed." );

if ( class_exists( 'Omise_FBBot_Message_Store' ) ) {
	return;
}

class Omise_FBBot_Message_Store {
	private function __construct() {
		// Hide the constructor
	}

	public static function get_greeting_message( $sender_id  ) {
		$user = Omise_FBBot_User_Service::get_user( $sender_id );
		$shop_name = get_bloginfo( 'name' );

		return sprintf(
			__( ':D Hello %1$s Welcome to %2$s, what are you looking for today ?', 'omise' ),
			$user['first_name'],
			$shop_name
		);
	}

	public static function get_helping_message() {
		$helping_message_1 = __( "😚 Don't worry, in spite of the fact i'm just a bot but i can help you. You can choose 1 choice from below.", 'omise' );

		$helping_message_2 = __( "Sure let me help you to shopping. You can choose 1 menu from below 😉", 'omise' );

		$helping_messages = array( $helping_message_1, $helping_message_2 );

		return self::ramdomArrayOfMessage( $helping_messages );
	}

	public static function get_unrecognized_message() {
		$default_message_1 = __( ":'(  I wish I could understand you, maybe one day! I’m here to help you shopping on Messenger app, Do you want to buy something ?", 'omise' );

		$default_message_2 = __( '🤖  Oh, I’m just a bot! but i have a cool stuff for cool people like you. Which do you like best ?', 'omise' );

		$default_message_3 = __( '🤖  I’m so sorry, I don’t understand what you tell me, but i will let my shop owner know and told him to help you.', 'omise' );

		$default_messages = array( $default_message_1, $default_message_2, $default_message_3 );

		$default_message = self::ramdomArrayOfMessage( $default_messages );

		return $default_message;
	}

	public static function get_feature_products_is_empty_message() {
		return __( "🤖  We don't have feature product for now. We will do it soon <3", 'omise' );
	}

	public static function get_products_is_empty_message() {
		return __( "🤖  We don't have product on this category. We will do it soon <3", 'omise' );
	}

	public static function get_product_image_is_empty_message() {
		return __( "🤖  This product don't have image gallery. We will do it soon <3", 'omise' );
	}

	public static function get_checking_order_helper_message() {
		return __( ":) Sure!. You can put your order number follow ex. #12345", 'omise' );
	}

	public static function get_rechecking_order_number_message() {
		return __( "🙇  If you want to check your order status, you can put your order number follow ex. #12345 👍", 'omise' );
	}

	public static function get_order_not_found_message() {
		return __( "Sorry, your order number not found. Can you try to check it again ? :'(", 'omise' );
	}

	public static function get_order_has_found_message( $order_status ) {
		return sprintf( __( "BAMM! Your order status is '%s' :]", 'omise' ), $order_status );
	}

	public static function get_prepare_confirm_order_message( $order_id ) {
		return sprintf( __( '🤖  We received your order. Your OrderID is 👉 #%s 👈. We will process your order right away and send you a confirmation once it is complete ❤', 'omise' ), $order_id );
	}

	public static function get_purchase_fail_message( $fail_message ) {
		return sprintf( __( 'Oops seems we cannot process your payment properly.. The reason is %s', 'omise' ), $fail_message );
	}

	public static function get_purchase_pending_with3ds_message() {
		return __( 'However, due to a 3rd-party payment processor, this process might takes a little while.', 'omise' );
	}

	public static function get_purchase_pending_message() {
		return __( "Now, the payment has been processing. I'll let you know once it done, thanks for your order.", 'omise' );
	}

	public static function get_purchase_reversed_message() {
		return __( 'I just reverse your payment as your request, this process might take few days to return your balance due to the bank issuer you are using.', 'omise' );
	}

	public static function get_purchase_completed_message() {
		return __( 'Any process to do more? No worry my friend, all done now. Next we will verify your order and payment then ship it!', 'omise' );
	}

	public static function get_unknow_purchase_status_message() {
		return __( 'BOOOOOOOOOOOOOOOOOOOO', 'omise' );
	}

	public static function get_default_menu_buttons() {
		$payload = Omise_FBBot_Payload;

		$feature_products_button = FB_Postback_Button_Item::create( __( 'Feature products', 'omise' ), $payload::FEATURE_PRODUCTS );
		$category_button = FB_Postback_Button_Item::create( __( 'Product category', 'omise' ), $payload::PRODUCT_CATEGORY );
		$check_order_button = FB_Postback_Button_Item::create( __( 'Check order status', 'omise' ), $payload::CHECK_ORDER );

		return array( $feature_products_button, $category_button , $check_order_button);
	}

	public static function check_greeting_words( $message ) {
		$greeting_words = array( 'hi', 'hello' );
		return in_array( $message, $greeting_words );
	}

	public static function check_helping_words( $message ) {
		$helping_words = array( 'help' );
		return in_array( $message, $helping_words );
	}

	public static function check_order_checking( $message ) {
		return ( mb_substr( $message, 0, 1 ) == '#' );
	}

	private static function ramdomArrayOfMessage( $messages) {
		return $messages[ mt_rand( 0, count( $messages ) - 1 ) ];
	}

}