<?php

require_once 'File.php';
require_once 'Directory.php';

class Templates{

	protected string $extension;
	protected array $folders;
	protected array $functions;
	protected array $sections;
	protected string $Layout;

	public function __construct(string $extension = '.tmp.php'){

		$this->extension = $extension;
	}

	public function addFolder($name, $folder){
		if(is_dir($folder)){
			$this->folders[$name] = new DirOBJ($folder);
			return;
		}
	}

	public function section(string $name){
		if(isset($this->sections[$name])){
			echo $this->sections[$name];
		}
		return;
	}

	public function layout(string $template){
		$this->Layout = $template;
		return;
	}

	public function render(string $str, array $options){

		$tmpdir = explode('::', $str)[0];
		$tmpfile = explode('::', $str)[1];

		$this->Layout = "";

		extract($options);

		if(isset($this->folders[$tmpdir])){
			$dirOBJ = $this->folders[$tmpdir];

			foreach ($dirOBJ->files as $file) {
				if($file->filename == $tmpfile){
					ob_start();
					require_once $file->dirname . '/' . $file->basename;
					$this->sections['content'] = ob_get_contents();
					ob_end_clean();

				}
			}

			if(isset($this->Layout) and !empty($this->Layout)){
				$this->render($this->Layout, []);
			}else{
				echo $this->sections['content'];
			}
		}
	}
}