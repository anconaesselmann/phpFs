<?php
namespace aae\fs {
	require_once strstr(__FILE__, 'Test', true).'/aae/autoload/AutoLoader.php';
	class FileTest extends \PHPUnit_Framework_TestCase {
		protected function _getDataPath() {
			$reflectedClass = new \ReflectionObject($this);
			$reflectedClassFileName = $reflectedClass->getFileName();
			return dirname($reflectedClassFileName)."/".(substr(strrchr(get_class($this), "\\"), 1))."Data";
		}

		/**
		 * @dataProvider provider___construct_exception_not_a_file
		 */
		public function test___construct_exception_not_a_file($pathString) {
			try {
				$obj = new File($pathString);
			} catch (\Exception $e) {
				$this->assertEquals(213141118, $e->getCode());
				return;
			}
			$this->fail("An exception should have been thrown since the supplied path is not a file.");
			
		}

		public function provider___construct_exception_not_a_file() {
			return array(
				array($this->_getDataPath()),
			);
		}

		/**
		 * @dataProvider provider___construct
		 */
		public function test___construct($pathString) {
			$obj = new File($pathString);
		}

		public function provider___construct() {
			return array(
				array($this->_getDataPath()."/file.php")
			);
		}

		/**
		 * TEST_DESCRIPTION
		 */
		public function test_getContents() {
			// Setup
			$obj = new File($this->_getDataPath()."/file.php");
			$expected = "file content";
		
			// Testing
			$result = $obj->getContents();
			
			// Verification
			$this->assertEquals($expected, $result);
		}
		
	}
}