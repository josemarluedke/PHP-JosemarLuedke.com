<?php
/**
 * @author			Josemar Davi Luedke <josemarluedke@gmail.com>
 * @copyright		Copyright 2011, Josemar Davi Luedke <http://josemarluedke.com>
 */
 
class PagesController extends AppController {
	public $cache = array('tweets' => 300);        
	public function tweets(){
		$this->autoLayout = false;
	}
}
