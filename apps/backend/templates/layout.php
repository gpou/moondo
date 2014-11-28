<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(
		function(){
			Shadowbox.init({
				handleOversize: 'resize',
				overlayColor:'#000000',
				overlayOpacity: '0.9',
				modal: true,
				players: ['html','img','iframe']
			});
		}
	);
//]]>
</script>
  </head>
  <body>
<?php $moduleName = sfContext::getInstance()->getRequest()->getParameter('module'); ?>
	  
	  <ul id="menu">
		  <li><a href="<?php echo url_for('presentacio') ?>">Presentació</a></li>
		  <li><a href="<?php echo url_for('espectacles') ?>">Espectacles</a></li>
		  <li><a href="<?php echo url_for('serveis') ?>">Serveis</a></li>
		  <li><a href="<?php echo url_for('formacio') ?>">El taller de les músiques</a></li>
		  <li><a href="<?php echo url_for('colaboradors') ?>">Col·laboradors</a></li>
		  <li><a href="<?php echo url_for('4mono') ?>">El 4º Mono</a></li>
		  <!--<li><a href="">Agenda</a></li>
		  <li><a href="">Contacte</a></li>-->
		  <li class="last"></li>
	  </ul>
	  
    <?php echo $sf_content ?>
	  
<script type="text/javascript"><!--
	var menu;
	$(document).ready(function() {
		$("#menu>li").hover(function() {
			$(this).find('ul').show();
		}, function() {
			$(this).find('ul').hide();
		});
	});
--></script>
  </body>
</html>
