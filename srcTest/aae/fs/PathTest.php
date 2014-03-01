<?php
namespace aae\fs {
	require_once strstr(__FILE__, 'Test', true).'/aae/autoload/AutoLoader.php';
	class PathTest extends \PHPUnit_Framework_TestCase {
		protected function _getDataPath() {
			$reflectedClass = new \ReflectionObject($this);
			$reflectedClassFileName = $reflectedClass->getFileName();
			return dirname($reflectedClassFileName)."/".(substr(strrchr(get_class($this), "\\"), 1))."Data";
		}


		/**
		 * @dataProvider provider___construct_exception_nonexistant_path
		 */
		/*public function test___construct_exception_nonexistant_path($pathString) {
			try {
				$obj = new Path($pathString);
			} catch (\Exception $e) {
				$this->assertEquals(213141057, $e->getCode());
				return;
			}
			$this->fail("An exception should have been thrown since the supplied path does not exist.");
			
		}*/

		public function provider___construct_exception_nonexistant_path() {
			return array(
				array($this->_getDataPath()."/nonexistantPath"),
				array($this->_getDataPath()."/nonexistantFile.php")
			);
		}

		/**
		 * @dataProvider provider___construct
		 */
		/*public function test___construct($pathString) {
			$obj = new Path($pathString);
		}*/

		public function provider___construct() {
			return array(
				array($this->_getDataPath()."/folder"),
				array($this->_getDataPath()."/file.php")
			);
		}
		/**
		 * TEST_DESCRIPTION
		 */
		/*public function test___toString() {
			// Setup
			$pathString = $this->_getDataPath()."/folder";
			$obj = new Path($pathString);
		
			// Testing
			$result = strval($obj);
			
			// Verification
			$this->assertEquals($pathString, $result);
		}*/
		public function test_resolve_one_indirection() {
			// Setup
			$obj = new File($this->_getDataPath()."/RemoveThis/../file.php");
			$path = "/Users/axelanconaesselmann/Dropbox/WebServer/aae_framework/fw_libraryTest/RemoveThis/../aae/ui/ViewControllerInterfaceTest.php";
			$expected = "/Users/axelanconaesselmann/Dropbox/WebServer/aae_framework/fw_libraryTest/aae/ui/ViewControllerInterfaceTest.php";
		
			// Testing
			#$result = $obj->resolve($path);
			
			// Verification
			#$this->assertEquals($expected, $result);
		}
		/*public function test_resolve_multiple_indirections() {
			// Setup
			
			$obj = new Path($this->_getDataPath()."/file.php");
			$path = "/a/path/to/removeThis/andThis/thisAsWell/../../../file.html";
			$expected = "/a/path/to/file.html";
		
			// Testing
			$result = $obj->resolve($path);
			
			// Verification
			$this->assertEquals($expected, $result);
		}*/
	}
}