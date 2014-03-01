<?php
/**
 *
 */
namespace aae\fs {
	/**
	 * @author Axel Ancona Esselmann
	 * @package aae\cdt
	 */
	class Path {
		protected $_pathString = null;
		public function __construct($pathString) {
			$realpath = $this->resolve($pathString);
			if (!file_exists($realpath)) throw new \Exception("Error: '$realpath' is not a valid path.", 213141057);
			$this->_pathString = $realpath;
		}
		public function __toString() {
			return strval($this->_pathString);
		}

		public function resolve($path) {
			$regex = "/(.?)(\/[^\/]*\/\.\.)(.*)/";
			$result = preg_replace($regex, "$1$3", $path);
			if ($result != $path) {
				$result = $this->resolve($result);
			}
			return $result;
		}
	}
}