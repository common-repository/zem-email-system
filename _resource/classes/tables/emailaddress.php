<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesemailaddresszTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'emailaddress'=> '',
	    'groupid'=> '',
	    'status'=> '',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('emailaddress', $this->columns);
   	}
}
?>