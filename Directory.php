<?php

class DirOBJ{

	public $path;
	public $files;
	
	public function __construct($path){
		$this->path = $path;
		$this->files = $this->get_content($this->path);
	}

	public function get_content($dir){
		$tmp = [];

		foreach (scandir($dir) as $archive) {
			if($archive != '.' or $archive != '..'){
				$tmp[] = new File($dir . '/' . $archive);
			}
		}

		return $tmp;
	}
}