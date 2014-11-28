<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<?php include_stylesheets() ?>
<?php include_javascripts() ?>
<!--[if gte IE 5.5]>
<![if lt IE 7]>
<link rel="StyleSheet" href="/css/generic_ie.css" type="text/css" media="screen" />
<![endif]>
<![endif]-->
<?php include_slot('head') ?>
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
<div id="fons_fora">
	<div id="fons">
		<div id="esq">
			<?php if (has_slot('imatge')): ?><img src="/images/<?php include_slot('imatge'); ?>" alt=""  class="png24" /><?php endif ?>
			<a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(72)->slug)) ?>" title="<?php echo PageTable::getPage(72)->titre ?>"><img src="/images/taller_musiques.png" alt="" style="right:50px;top:0;width:auto;height:auto"/></a>
		</div>
		<div id="baix">
				<div id="peu">
					<p>Khan cartrö | <?php echo mail_to('info@khan-cartro.com','','encode=true') ?> | 972 236 907 | <a href="<?php echo url_for('contacte') ?>" title="<?php echo __('Contacte') ?>"><?php echo __('Contacte') ?></a></p>
				</div>
		</div>
	</div>
</div>
<div id="tot">
	<div id="mig">
	<div id="dret">
		<?php include_partial('global/menu') ?>

	</div>
	<div id="caixa">
		<div id="idiomes">
			<a href="<?php echo url_for('language',array('sf_culture'=>'ca')) ?>"<?php echo $sf_user->getCulture()=='ca'?' class="actiu"':'' ?> title="català">català</a> | 
			<a href="<?php echo url_for('language',array('sf_culture'=>'es')) ?>"<?php echo $sf_user->getCulture()=='es'?' class="actiu"':'' ?> title="español">español</a> | 
			<a href="<?php echo url_for('language',array('sf_culture'=>'en')) ?>"<?php echo $sf_user->getCulture()=='en'?' class="actiu"':'' ?> title="english">english</a> | 
			<a href="<?php echo url_for('language',array('sf_culture'=>'fr')) ?>"<?php echo $sf_user->getCulture()=='fr'?' class="actiu"':'' ?> title="français">français</a>
		</div>
		<div id="login">&nbsp;<?php /*usuari desconegut | <a href="sessio.php?a=form_connectar" title="entra">entra</a>*/ ?></div>
	</div>


	<div id="contingut">

		<?php echo $sf_content ?>

	</div>
</div></div>


<script type="text/javascript"><!--
$(document).ready(function() {
	//alert($("#fons_fora").height()+', '+$("#mig").height())
	if ($("#mig").height()<$("#dret").height()) $("#mig").css('height',$("#dret").height()+'px');
	if ($("#fons_fora").height() < $("#mig").height()) {
		//alert($("#mig").height()+'px');
		$("#fons_fora").css('height',$("#mig").height()+'px');
	}
});	
--></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23530171-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
