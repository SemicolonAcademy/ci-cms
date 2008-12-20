<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @version $Id$
 * @package solaitra
 * @copyright Copyright (C) 2005 - 2008 Tsiky dia Ampy. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 */

/**
 * deal with updating tables or creating folders when changes happen
 */
 $this->obj->load->dbforge();
 //update to 0.2.0.0
if ($this->version < '0.2.0.1')
{
 
	@mkdir('./media/images');
	@mkdir('./media/images/s');
	@mkdir('./media/images/m');
	@mkdir('./media/images/o');

	$this->set('version', '0.2.0.0');
	
 }
 
 
 // update to 0.2.0.1
 
 if ($this->version < '0.2.0.1')
 {
	$fields = array(
		'activation' => array('type' => 'varchar', 'constraint' => '100', 'default' => '')
	);
	$this->obj->dbforge->add_column('users', $fields);

	$this->set('version', '0.2.0.1');
	
 }
 
 