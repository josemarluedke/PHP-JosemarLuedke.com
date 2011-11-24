<?php 
/**
 * Componente para pegar os últimos tweets de um usuário do twitter
 * 
 * Copyright Copyright 2010, Josemar Davi Luedke <josemarluedke@gmail.com>
 * 
 * Licenciado sob a licença MIT
 * Redistribuições de arquivos e/ou partes de códigos devem manter o aviso de copyright acima.
 * 
 * @author Josemar Davi Luedke <josemarluedke@gmail.com>
 * @version 0.1.0
 * @copyright Copyright 2010, Josemar Davi Luedke <josemarluedke@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class LastTweetsComponent extends Component {
	
	/**
	 * Componentes dependentes
	 * @var array
	 */
	public $components = array('session');
	
	/**
	 * Id ou nome do usuário do twitter ex: zeanwork
	 * @var string
	 */
	var $twitterId = 'josemarluedke';
	
	/**
	 * Formato da data a ser mostrada
	 * @var string
	 */
	var $dateFormat = 'brtime';
	
	/**
	 * Limite de tweets a ser mostrado
	 * @var numeric
	 */
	var $limitOfTweets = 5;
	
	/**
	 * Array contendo a estrutura HTML da listagem dos tweets
	 * @var array
	 */
	var $html = array(
					  'start' => "<ul class=\"tweets\">"
					, 'tweet' => "<li class=\"tweet\"><span class=\"tweetStatus\">%s</span><br /><span class=\"tweetDate\">%s</span></li>"
					, 'end' => "</ul>"
	);

	/**
	 * Pega os dados do twitter
	 * @return XML Object
	 */
	public function getContents(){
		$response = @file_get_contents('http://twitter.com/statuses/user_timeline/'.$this->twitterId.'.xml');
		if($response){
			if(class_exists('SimpleXMLElement')){
				$xml = new SimpleXMLElement($response);
			return $xml;
			}else{
				return $response;
			}
		}else{
			return false;
		}
	}

	/**
	 * Processa os links do tweet
	 * @param string $text
	 * @return string
	 */
	public function processLinks($text){
		$text = utf8_decode($text);
		$text = preg_replace('@(https?://([-\w\.]+)+(d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1" target="_black">$1</a>', $text);
		$text = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $text);  
		$text = preg_replace("#(^|[\n ])\#([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://twitter.com/search?q=%23\\2\" >#\\2</a>'", $text);
		return $text;
	}
	
	/**
	 * Pega os tweets
	 * @return string
	 */
	public function getTweets(){
		$output = null;
		$output .= $this->html['start'];
		if($xml = $this->getContents()){
			$i = 0;
			if(Configure::exist('charset')){
				if(strtoupper(Configure::read('charset')) == 'UTF-8')
					$utf8 = true;
				else
					$utf8 = false;
			}else
				$utf8 = false;
			foreach($xml->status as $key => $value){
				if($utf8 == true)
					$value->text = utf8_encode($value->text);
				$output .= sprintf($this->html['tweet'], $this->processLinks($value->text), Date::convert(date('d/m/Y H:i:s', strtotime($value->created_at)), $this->dateFormat));
				$i++;
				if($this->limitOfTweets == $i) break;
			}
		}else{
			$output .= sprintf($this->html['tweet'], 'Twitter seems to be unavailable at the moment.', null);
		}
		$output .= $this->html['end'];
		return $output;
	}

	/**
	 * Seta o id ou nome do usuário do twitter ex: zeanwork
	 * @param string $twitterId
	 * @return no return
	 */
	public function setTwitterId($twitterId){
		$this->twitterId = $twitterId;
	}
	
	/**
	 * Seta o limite de tweets a ser mostrado
	 * @param numeric $limitOfTweets
	 * @return no return
	 */
	public function setLimitOfTweets($limitOfTweets){
		$this->limitOfTweets = $limitOfTweets;
	}
	
	public function initialize(&$controller){
		return true;
	}
	
	public function startup(&$controller){
		return true;
	}
	
	public function shutdown(&$controller){
		return true;
	}
	
}