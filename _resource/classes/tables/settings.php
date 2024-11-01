<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemessettingszTable extends zemesztable{

	public $columns = array(
	    'settingname'=> '',
	    'settingvalue'=> '',
	);

	function __construct() {
		parent::__construct('settings', $this->columns);
   	}
}
?>