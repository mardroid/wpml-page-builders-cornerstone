<?php

/**
 * Class Test_WPML_PB_Cornerstone_Handle_Custom_Fields_Factory
 *
 * @group cornerstone
 */
class Test_WPML_PB_Cornerstone_Handle_Custom_Fields_Factory extends OTGS_TestCase {

	/**
	 * @test
	 */
	public function it_creates_instance_of_custom_fields_handler() {
		$subject = new WPML_PB_Cornerstone_Handle_Custom_Fields_Factory();
		$this->assertInstanceOf( 'WPML_PB_Handle_Custom_Fields', $subject->create() );
	}
}