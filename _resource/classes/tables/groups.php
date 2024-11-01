<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesgroupszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'name'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('groups', $this->columns);
   	}
}
?>