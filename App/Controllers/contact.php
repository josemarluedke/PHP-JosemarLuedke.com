<?php
/**
 * @author			Josemar Davi Luedke <josemarluedke@gmail.com>
 * @copyright		Copyright 2011, Josemar Davi Luedke <http://josemarluedke.com>
 */
 
class ContactController extends AppController {
    
	public $helpers = array('html');
	
	
	public function index(){
		$this->view['message'] = false;
		if($this->input->post()){
			$msgEmail = '<html>
							<head>
							<meta http-equiv="Content-Type" content="text/html; charset='.Configure::read('charset').'"/>
							</head>
							<body>
								<h1>Contato pelo site JosemarLuedke.com</h1>
								<br />
								<b>Nome: </b> '.$this->input->post('name').'
								<br />
								<b>E-mail: </b> '.$this->input->post('email').'
								<br />
								<b>Site/Blog: </b> '.$this->input->post('webSite').'
								<br />
								<b>Mensagem: </b>
								<br /><br />
								'.Util::bbcode($this->input->post('mensagem')).'
							</body>
							</html>';
			
		    $header= "From: Josemar Davi Luedke<josemarluedke@gmail.com>\r\n";
		    $header.= "Reply-To:".$this->input->post('email')."\r\n";
		    $header.="Content-Type: text/html; charset=".Configure::read('charset')."\r\n";
		    
			$x = mail('josemarluedke@gmail.com', '[Site Josemar] Contato pelo site JosemarLuedke.com', $msgEmail, $header);
			if($x)
				$this->view['message'] = Translate::_('E-mail foi enviado').'!';
			else
				$this->view['message'] = Translate::_('E-mail não enviado').'!';
		}
	}
	
}