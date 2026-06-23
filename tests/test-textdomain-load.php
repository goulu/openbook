<?php
/**
 * Class OpenBook_TextDomain_Load_Test
 *
 * @package OpenBook
 */

class OpenBook_TextDomain_Load_Test extends WP_UnitTestCase {

	private $doing_it_wrong_triggered = false;
	private $doing_it_wrong_message = '';

	/**
	 * Setup hook to monitor _doing_it_wrong notices.
	 */
	public function set_up() {
		parent::set_up();
		$this->doing_it_wrong_triggered = false;
		$this->doing_it_wrong_message = '';
		add_action( 'doing_it_wrong_run', array( $this, 'catch_doing_it_wrong' ), 10, 3 );
	}

	/**
	 * Tear down hooks.
	 */
	public function tear_down() {
		remove_action( 'doing_it_wrong_run', array( $this, 'catch_doing_it_wrong' ), 10 );
		parent::tear_down();
	}

	/**
	 * Callback to catch doing_it_wrong occurrences.
	 */
	public function catch_doing_it_wrong( $function_name, $message, $version ) {
		if ( false !== stripos( $message, 'openbook4wordpress' ) || false !== stripos( $function_name, '_load_textdomain_just_in_time' ) ) {
			$this->doing_it_wrong_triggered = true;
			$this->doing_it_wrong_message = $message;
		}
	}

	/**
	 * Test that no early translation loading occurs.
	 */
	public function test_no_early_translation_loading() {
		// Verify that our hook has not caught any early loading warnings
		$this->assertFalse(
			$this->doing_it_wrong_triggered,
			'Doing it wrong warning was triggered: ' . $this->doing_it_wrong_message
		);

		// Verify constants are loaded correctly
		$this->assertTrue( defined( 'OB_BOOKNUMBERREQUIRED_LANG' ), 'OpenBook translation constants are not defined.' );
	}
}
