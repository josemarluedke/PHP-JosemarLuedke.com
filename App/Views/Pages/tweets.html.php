<?php
/**
 * @author			Josemar Davi Luedke <josemarluedke@gmail.com>
 * @copyright		Copyright 2011, Josemar Davi Luedke <http://josemarluedke.com>
 */
 
$this->load->extension('date');

$this->load->component('lastTweets');

$this->lastTweets->setLimitOfTweets(3);

echo $this->lastTweets->getTweets();

?>