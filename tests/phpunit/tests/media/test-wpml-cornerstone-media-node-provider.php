<?php

/**
 * @group media
 */
class Test_WPML_Cornerstone_Media_Node_Provider extends OTGS_TestCase {

	/**
	 * @test
	 * @dataProvider dp_node_types
	 *
	 * @param string $type
	 * @param string $class_name
	 */
	public function it_should_return_a_node_instance_and_cache_it( $type, $class_name ) {
		$GLOBALS['sitepress'] = $this->getMockBuilder( 'SitePress' )->disableOriginalConstructor()->getMock();
		$this->mock_external_classes();

		$media_translate = $this->getMockBuilder( 'WPML_Page_Builders_Media_Translate' )
		                        ->disableOriginalConstructor()->getMock();

		$subject = new WPML_Cornerstone_Media_Node_Provider( $media_translate );

		$this->assertInstanceOf( $class_name, $subject->get( $type ) );
		$this->assertSame( $subject->get( $type ), $subject->get( $type ) );
	}

	public function dp_node_types() {
		return array(
			'image'                => array( 'image', 'WPML_Cornerstone_Media_Node_Image' ),
			'classic:creative-cta' => array( 'classic:creative-cta', 'WPML_Cornerstone_Media_Node_Classic_Creative_CTA' ),
			'classic:feature-box'  => array( 'classic:feature-box', 'WPML_Cornerstone_Media_Node_Classic_Feature_Box' ),
			'classic:card'         => array( 'classic:card', 'WPML_Cornerstone_Media_Node_Classic_Card' ),
			'classic:image'        => array( 'classic:image', 'WPML_Cornerstone_Media_Node_Classic_Image' ),
			'classic:promo'        => array( 'classic:promo', 'WPML_Cornerstone_Media_Node_Classic_Promo' ),
		);
	}

	private function mock_external_classes() {
		$this->getMockBuilder( 'WPML_Translation_Element_Factory' )->getMock();
		$this->getMockBuilder( 'WPML_Media_Image_Translate' )->getMock();
		$this->getMockBuilder( 'WPML_Media_Attachment_By_URL_Factory' )->getMock();
	}
}