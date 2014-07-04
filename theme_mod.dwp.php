<?php
/*
*********************************
deployWP - theme mod
*********************************
*/
class deploy_theme_mod extends deployWP_module {

	/**
	 *
	 *
	 * @return void
	 **/
	function setup(){
		$this->collect_file = $this->env_dir.'/theme_mod.json';
		$this->deploy_file 	= $this->deploy_from_dir.'/theme_mod.json';
	}


	/**
	 * 
	 * 
	 * @return void
	 **/
	function collect(){

		$mods = array();
		$themes = get_themes();
		if(!$themes)
			return false;

		foreach($themes as $key => $theme){
			$handle = $theme->stylesheet;
			if($mod = get_option('theme_mods_'.$handle))
				$mods[$handle] = $mod;
		}

		$file = $this->collect_file;
		$file = fopen($file, 'w+');
		fwrite($file, json_encode($mods));
		fclose($file);

	}

	/**
	 *
	 *
	 * @return void
	 **/
	function deploy(){
		/* Collect code goes here */
		if(file_exists($this->deploy_file)){
			if($mods = json_decode(file_get_contents($this->deploy_file), JSON_ARRAY)){
				foreach($mods as $handle => $mod)
					update_option('theme_mods_'.$handle, $mod);
			}

		}
	}

}
?>
