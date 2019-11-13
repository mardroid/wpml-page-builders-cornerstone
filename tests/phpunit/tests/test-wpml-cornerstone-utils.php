<?php

use WPML\PB\Cornerstone\Utils;

/**
 * Class Test_WPML_Cornerstone_Utils
 *
 * @group cornerstone
 */
class Test_WPML_Cornerstone_Utils extends OTGS_TestCase {

	/**
	 * @test
	 */
	public function test_get_node_id() {
		$data = [ 'test' => 'value' ];
		$expected = md5( serialize( $data ) );

		$this->assertEquals( $expected, Utils::getNodeId( $data ) );
	}

	/**
	 * @test
	 * @dataProvider dp_type_is_layout
	 */
	public function test_type_is_layout( $type, $expected ) {
		$this->assertEquals( $expected, Utils::typeIsLayout( $type ) );
	}

	/**
	 * Data provider for test_type_is_layout.
	 */
	public function dp_type_is_layout() {
		return [
			[ 'bar', true ],
			[ 'container', true ],
			[ 'section', true ],
			[ 'row', true ],
			[ 'column', true ],
			[ 'layout-row', true ],
			[ 'layout-column', true ],
			[ 'layout-grid', true ],
			[ 'layout-cell', true ],
			[ 'classic:section', true ],
			[ 'classic:row', true ],
			[ 'classic:column', true ],
			[ 'headline', false ],
			[ 'classic:headline', false ],
		];
	}
}