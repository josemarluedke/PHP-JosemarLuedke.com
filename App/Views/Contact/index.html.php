<?php
/**
 * @author			Josemar Davi Luedke <josemarluedke@gmail.com>
 * @copyright		Copyright 2011, Josemar Davi Luedke <http://josemarluedke.com>
 */
 
$this->pageTitle = Translate::_('Contato');
$this->load->helper('form');
?>
<div class="title"><img src="<?php echo IMG?>at.png" style="padding-bottom: 15px; vertical-align: middle;" /> <?php echo Translate::_('Contato'); ?></div>

<?php echo Translate::_('textPrincContact')?>
<br /><br />


<script type="text/javascript">
	$(document).ready(function(){

		<?php
			if($data['message'] != false)
				echo 'alert("'.$data['message'].'");';
		?>
		
		$('form#contact').submit(function(){
			if($('input#name').val() == ''){
				alert('<?php echo Translate::_('Você deve preencher o campo nome')?>!');
				$('input#name').focus();
				return false;
			}
			if($('input#email').val() == ''){
				alert('<?php echo Translate::_('Você deve preencher o campo e-mail')?>!');
				$('input#email').focus();
				return false;
			}else{
				email = document.getElementById('email');
				string_mail = email.value;
				letra1 = "@";
				letra2 = ".";
				pos1 = string_mail.indexOf(letra1);
				pos2 = string_mail.indexOf(letra2);
				if((email.value.length < 6) || (pos1 < 1) || (pos2 < 1) || (pos1 == email.value.length - 1) || (pos2 == email.value.length - 1)) {
					alert('<?php echo Translate::_('Por favor, informe um e-mail correto')?>!');
					email.focus();
					return false;
				}
			}
			if($('#mensagem').val() == ''){
				alert('<?php echo Translate::_('Você deve preencher o campo mensagem')?>!');
				$('input#mensagem').focus();
				return false;
			}
		});
	});
</script>

<?php
echo $this->form->start('contact');

echo $this->form->input('name', array(
										  'label' => Translate::_('Nome').':'
										, 'divForLabel' => array('style' => 'margin-top:5px;')
										, 'divForInput' => true
										, 'class' => 'inputContact'
									)
							);

echo $this->form->input('email', array(
										  'label' => 'E-mail:'
										, 'divForLabel' => array('style' => 'margin-top:5px;')
										, 'divForInput' => true
										, 'class' => 'inputContact'
									)
							);
							
echo $this->form->input('webSite', array(
										  'label' => 'Site/Blog:'
										, 'divForLabel' => array('style' => 'margin-top:5px;')
										, 'divForInput' => true
										, 'value' => ''
										, 'class' => 'inputContact'
									)
							);
							
echo $this->form->input('mensagem', array(
										  'label' => Translate::_('Mensagem').':'
										, 'divForLabel' => array('style' => 'margin-top:5px;')
										, 'divForInput' => true
										, 'value' => ''
										, 'type' => 'textarea'
									)
							);
							

echo br(2) . $this->form->submit('submit', array('value' => Translate::_('Enviar'), 'class' => 'submit'));
echo $this->form->end();
?>
