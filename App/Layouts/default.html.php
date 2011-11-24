<?php
/**
 * @author			Josemar Davi Luedke <josemarluedke@gmail.com>
 * @copyright		Copyright 2011, Josemar Davi Luedke <http://josemarluedke.com>
 */

$this->load->helper('html');
?>
<!DOCTYPE html>
<html lang="<?php echo Inflector::underscore(Configure::read('toLanguage')); ?>">
	<head>
		<title><?php echo $this->pageTitle; echo ($this->pageTitle != null) ? ' -' : ''; ?> Josemar Davi Luedke | Web Developer</title>
		<?php
			echo $this->html->metaCharset();
			echo $this->html->css('geral');
			echo $this->html->js('jQuery');
			echo $this->html->jsBlock('var APP_HOST = "'.APP_HOST.'";', null);
		?>
	</head>
	<body>
		<div id="selectLanguage">
			<?php 
				if($this->getParam('controller') == 'Contact')
					$add = '/contact';
				else
					$add = null;
				echo $this->html->imgLink(Router::url('/pt-BR'.$add), 'brazilFlag.jpg', array('title' => Translate::_('Português Brasil'), 'style' => 'margin-right: 5px;'));
				echo $this->html->imgLink(Router::url('/en'.$add), 'usaFlag.jpg', array('title' => Translate::_('Inglês')));
			?>
		</div>
		<div id="top"><h1>Josemar Davi Luedke - Web Developer</h1></div>
		<header id="menu">
			<ul>
				<li style="margin-left: 0px;"><?php echo $this->html->link(Translate::_('Home'), Router::url('/')); ?></li>
				<li><?php echo $this->html->link('Twitter', 'http://twitter.com/JosemarLuedke', array('target' => '	_blank')); ?></li>
				<li><?php echo $this->html->link('Facebook', 'http://www.facebook.com/josemar.luedke', array('target' => '	_blank')); ?></li>
				<li><?php echo $this->html->link('LinkedIn', 'http://www.linkedin.com/in/josemarluedke', array('target' => '	_blank')); ?></li>
				<li><?php echo $this->html->link('GitHub', 'http://github.com/josemarluedke/', array('target' => '	_blank')); ?></li>
				<li><?php echo $this->html->link('YouTube', 'http://youtube.com/user/josemarluedke', array('target' => '	_blank')); ?></li>
				<li><?php echo $this->html->link('Blog', 'http://blog.josemarluedke.com'); ?></li>
				<li><?php echo $this->html->link('E-mail', 'mailto:josemarluedke@gmail.com'); ?></li>
				<li><?php echo $this->html->link(Translate::_('Currículo em PDF'), 'http://josemarluedke.com/curriculum.pdf'); ?></li>
				<li><?php echo $this->html->link('Zeanwork', 'http://zeanwork.com.br', array('target' => '	_blank')); ?></li>
				<li><?php echo $this->html->link(Translate::_('Contato'), Router::url('/contact')); ?></li>
			</ul>
			<div class="clear"></div>
		</header>
		<section>
			<div id="content">
				<?php echo $this->contentForLayout; ?>
			</div>
			<div id="lastTweets">
				<div class="title"><img src="<?php echo IMG?>twitter.png" style="padding-bottom: 15px; vertical-align: middle;" /> <?php echo Translate::_('Últimos tweets'); ?></div>
				<div id="contentTwitter">
					<script type="text/javascript">
						$(document).ready(function(){
							$.ajax({
								type: "GET",
								url: APP_HOST + 'pages/tweets',
								data: '',
								cache: false,
								beforeSend: function(){
									$('#contentTwitter').html('<center><?php echo $this->html->img("ajax-loader.gif"); ?></center>');
								},
								success: function(txt){
									$('#contentTwitter').html(txt);
								},
								error: function(){
									$('#contentTwitter').html('Twitter seems to be unavailable at the moment.');
								},
								stop: function(){
										$('#contentTwitter').html('Twitter seems to be unavailable at the moment.');
									}
							});
						});
					</script>
				</div>
			</div>
			<div class="clear"></div>
		</section>
		<footer>
			<?php echo date('Y')?> &copy; Josemar Davi Luedke
		</footer>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-13128274-4']);
			_gaq.push(['_setDomainName', '.josemarluedke.com']);
			_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	</body>
</html>