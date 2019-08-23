<?php
/* By Lukáš Plevač
under apache 2.0
https://www.apache.org/licenses/LICENSE-2.0
*/

class template {
	private $name;
	public $min = false;

    
	function __construct($name) {
    	$this->name = $name;
	}

	public function createToVar($data){
		//Načtení html souboru
		$templatefile = file_get_contents(dirname(__FILE__ ) . "/../templates/$this->name.html");
		
		//Nalezení všech ##key## (Slouží pro zavedení jiného html)
		preg_match_all('/\##(.*?)\##/', $templatefile, $matches);
		//Odstranění duplikátů
		$matches = array_map('array_unique', $matches);
		//Nahrazení všech ##key## za html kód z souborů
		foreach( $matches[1] as $key ) {
			$htmlinclude = file_get_contents(dirname(__FILE__ ) . "/../templates/$key.html");
			$templatefile = str_replace("##$key##", $htmlinclude, $templatefile);
		}
		
		$data['year'] = date("Y");
		//$data['node'] = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ?  $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER("HTTP_HOST");
		
		//Nahrazení %%key%% za hodnoty z php
		foreach ($data as $key => $value) {
			$templatefile = str_replace("%%$key%%", $value, $templatefile);
		}
		
		//Minimalizace kódu na jeden řádek
		if ($this->min) {
			$templatefile = preg_replace("/\s+|\n+|\r/", ' ', $templatefile);
		}
		
		return $templatefile;
	}
	
	public function create($data){
		echo $this->createToVar($data);
	}
}
?>
