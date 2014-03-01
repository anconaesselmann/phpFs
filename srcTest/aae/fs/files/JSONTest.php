<?php
namespace aae\fs\files {
	require_once strstr(__FILE__, 'Test', true).'/aae/autoload/AutoLoader.php';
	class JSONTest extends \PHPUnit_Framework_TestCase {
		protected function _getDataPath() {
			$reflectedClass = new \ReflectionObject($this);
			$reflectedClassFileName = $reflectedClass->getFileName();
			return dirname($reflectedClassFileName)."/".(substr(strrchr(get_class($this), "\\"), 1))."Data";
		}

		/**
		 * @dataProvider provider___construct
		 */
		public function test___construct($pathString) {
			$obj = new JSON($pathString);
		}

		public function provider___construct() {
			return array(
				array($this->_getDataPath()."/file.json")
			);
		}

		/**
		 * @dataProvider provider___construct_with_comments
		 */
		public function test___construct_with_comments($pathString) {
			$obj = new JSON($pathString, true);
		}

		public function provider___construct_with_comments() {
			return array(
				array($this->_getDataPath()."/withComments.json")
			);
		}

		/**
		 * @dataProvider provider___construct_exception_not_a_file
		 */
		public function test___construct_exception_not_a_file($pathString, $errorCode) {
			try {
				$obj = new JSON($pathString);
			} catch (\Exception $e) {
				$this->assertEquals($errorCode, $e->getCode());
				return;
			}
			$this->fail("An exception should have been thrown since the file is corrupt.");
			
		}

		public function provider___construct_exception_not_a_file() {
			return array(
				array($this->_getDataPath()."/corrupt.json", 213141145),
				array($this->_getDataPath()."/withComments.json", 213141145),
			);
		}
		
		public function test_interfaces() {
			// Setup
			$pathString = $this->_getDataPath()."/file.json";
			$obj = new JSON($pathString);
		
			// Testing
			$countResult = count($obj);
			$firstResult = $obj["test"];
			$itterationResult = 0;

			foreach ($obj as $key => $value) {
				$itterationResult += $value;
			}
			
			// Verification
			$this->assertEquals(3, $countResult);
			$this->assertEquals(7, $firstResult);
			$this->assertEquals(42, $itterationResult);
		}

		/**
		 * TEST_DESCRIPTION
		 */
		public function test___toString() {
			// Setup
			$obj = new JSON($this->_getDataPath()."/file.json");
			$expected = $obj->getContents();
		
			// Testing
			$result = strval($obj);
			
			// Verification
			$this->assertEquals($expected, $result);
		}
	}
}