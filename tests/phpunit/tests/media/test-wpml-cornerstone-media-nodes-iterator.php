<?php

/**
 * @group media
 */
class Test_WPML_Cornerstone_Media_Nodes_Iterator extends OTGS_TestCase {

	/**
	 * @test
	 */
	public function it_should_translate() {
		$lang        = 'fr';
		$source_lang = 'en';

		$image_data = array(
			'src'   => 'http://example.org/dog.jpg',
			'_type' => 'image',
		);

		$image_data_translated = array(
			'src'   => 'http://example.org/chien.jpg',
			'_type' => 'image',
		);

		$data = array(
			array(
				'foo'   => 'bar',
				'_type' => 'column',
				'_modules' => array(
					array( 'unknown / not translated' ),
					array(
						'foo'   => 'bar',
						'_type' => 'not-supported',
					),
					$image_data,
				)
			),
		);

		$expected_data = array(
			array(
				'foo'   => 'bar',
				'_type' => 'column',
				'_modules' => array(
					array( 'unknown / not translated' ),
					array(
						'foo'   => 'bar',
						'_type' => 'not-supported',
					),
					$image_data_translated
				)
			),
		);

		$node_image = $this->get_node();
		$node_image->method( 'translate' )->with( $image_data, $lang, $source_lang )
			->willReturn( $image_data_translated );

		$node_provider = $this->get_node_provider();
		$node_provider->method( 'get' )->willReturnMap(
			array(
				array( 'image', $node_image ),
				array( 'not-supported', null ),
			)
		);

		$subject = $this->get_subject( $node_provider );

		$this->assertEquals( $expected_data, $subject->translate( $data, $lang, $source_lang ) );
	}

	private function get_subject( $node_provider ) {
		return new WPML_Cornerstone_Media_Nodes_Iterator( $node_provider );
	}

	private function get_node_provider() {
		return $this->getMockBuilder( 'WPML_Cornerstone_Media_Node_Provider' )
			->setMethods( array( 'get' ) )->disableOriginalConstructor()->getMock();
	}

	private function get_node() {
		return $this->getMockBuilder( 'WPML_Cornerstone_Media_Node' )
		            ->setMethods( array( 'translate' ) )->disableOriginalConstructor()->getMock();
	}
}

if ( ! interface_exists( 'IWPML_PB_Media_Nodes_Iterator' ) ) {
	interface IWPML_PB_Media_Nodes_Iterator {}
}