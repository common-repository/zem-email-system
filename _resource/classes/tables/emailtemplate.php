<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesemailtemplatezTable extends zemesztable{

	public $columns = array(
	    'id'=> '',
	    'title'=> '',
	    'subject'=> '',
	    'body'=> '',
	    'status'=> '5',
	    'created'=> ''
	);

	function __construct() {
		parent::__construct('emailtemplates', $this->columns);
   	}
}
?>