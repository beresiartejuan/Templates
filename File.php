<?php

class File{

	public $dirname, $basename, $extension, $filename, $content;

	public function __construct(string $path){

		if(is_file($path) and is_readable($path)){
			foreach (pathinfo($path) as $key => $value) {
				$this->$key = $value;
			}
			$this->content = file_get_contents($this->dirname . '/' . $this->basename);
		}
	}
}