<?php

/**
 * @group media
 */
class Test_WPML_Cornerstone_Media_Node_Classic_Image extends OTGS_TestCase {

	/**
	 * @test
	 */
	public function it_should_translate() {
		$source_lang    = 'en';
		$target_lang    = 'fr';
		$original_url   = 'http://example.org/dog.jpg';
		$translated_url = 'http://example.org/chien.jpg';

		$settings = array(
			'foo'   => 'bar',
			'src'   => $original_url,
			'_type' => 'classic:image',
		);

		$expected_settings = array(
			'foo'   => 'bar',
			'src'   => $translated_url,
			'_type' => 'classic:image',
		);

		$media_translate = $this->getMockBuilder( 'WPML_Page_Builders_Media_Translate' )
		                        ->disableOriginalConstructor()->getMock();
		$media_translate->method( 'translate_image_url' )
		                ->with( $original_url, $target_lang, $source_lang )
		                ->willReturn( $translated_url );

		$subject = new WPML_Cornerstone_Media_Node_Classic_Image( $media_translate );

		$this->assertEquals( $expected_settings, $subject->translate( $settings, $target_lang, $source_lang ) );
	}
}
