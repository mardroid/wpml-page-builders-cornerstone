<?php

/**
 * Class Test_WPML_Cornerstone_Data_Settings
 *
 * @group cornerstone
 */
class Test_WPML_Cornerstone_Data_Settings extends OTGS_TestCase {

	/**
	 * @test
	 */
	public function it_gets_meta_field() {
		$subject = new WPML_Cornerstone_Data_Settings();
		$this->assertEquals( '_cornerstone_data', $subject->get_meta_field() );
	}

	/**
	 * @test
	 */
	public function it_gets_node_id_field() {
		$subject = new WPML_Cornerstone_Data_Settings();
		$this->assertEquals( '_type', $subject->get_node_id_field() );
	}

	/**
	 * @test
	 */
	public function it_gets_field_to_copy() {
		$subject = new WPML_Cornerstone_Data_Settings();
		$this->assertEquals( array( '_cornerstone_settings', '_cornerstone_version', 'post_content' ), $subject->get_fields_to_copy() );
	}

	/**
	 * @test
	 */
	public function it_converts_data_to_array() {
		$subject        = new WPML_Cornerstone_Data_Settings();
		$data           = json_encode( array(
			array(
				'something' => 'something'
			)
		) );
		$converted_data = json_decode( $data, true );

		$this->assertEquals( $converted_data, $subject->convert_data_to_array( $data ) );
	}

	/**
	 * @test
	 */
	public function it_prepares_data_for_saving() {
		$subject = new WPML_Cornerstone_Data_Settings();
		$data    = array(
			array(
				'something' => 'something'
			)
		);

		$converted_data = json_encode( $data );

		\WP_Mock::passthruFunction( 'wp_slash' );

		\WP_Mock::userFunction( 'wp_json_encode', array(
			'args'   => array( $data ),
			'return' => function ( $data ) {
				return json_encode( $data );
			}
		) );

		$this->assertEquals( $converted_data, $subject->prepare_data_for_saving( $data ) );
	}

	/**
	 * @test
	 */
	public function it_gets_pb_name() {
		$subject = new WPML_Cornerstone_Data_Settings();
		$this->assertEquals( 'Cornerstone', $subject->get_pb_name() );
	}

	/**
	 * @test
	 */
	public function it_gets_fields_to_save() {
		$subject = new WPML_Cornerstone_Data_Settings();
		$this->assertEquals( array( '_cornerstone_data' ), $subject->get_fields_to_save() );
	}
}