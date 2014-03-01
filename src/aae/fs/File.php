<?php
/**
 *
 */
namespace aae\fs {
	/**
	 * @author Axel Ancona Esselmann
	 * @package aae\fs
	 */
	class File extends Path {
		public function __construct($pathString) {
			parent::__construct($pathString);
			if (!is_file($this->_pathString)) throw new \Exception("Error: '$pathString' is not a file.", 213141118);
		}
	
		public function getContents() {
			return file_get_contents($this->_pathString);
		}
	}
}