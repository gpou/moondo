<?php slot('imatge','img_contacte.png'); ?>

		<h2><?php echo __('Contacte') ?></h2>
		<p>&nbsp;</p>

		<table style="width:100%">
			<tr>
				<td style="vertical-align:bottom;">
					<p><b>KHAN CARTRÖ<br /><?php echo __('Factoria artística') ?></b></p>
					<p><?php echo __('E-mail') ?>:<br /><?php echo mail_to('info@khan-cartro.com','','encode=true') ?><br /><?php echo mail_to('tallermusiques@khan-cartro.com','','encode=true') ?></p>
					<p><?php echo __('Telf') ?>:<br />655 936 297</p>
					<p>SALT</p>
				</td>
				<td style="text-align:right"><div id="mapa"></div></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:right">
					<small><a target="_blank" href="http://maps.google.com/?ie=UTF8&hq=&ll=41.974159,2.792586&z=17"><?php echo __('Veure el mapa més gran') ?></a></small>
				</td>
			</tr>
		</table>
		<?php if ($sf_user->hasFlash('enviat')): ?>
		<h4><?php echo __('T\'hem inscrit a la nostra llista de correu') ?></h4>
		<p>Hem afegit la teva adreça a la nostra llista de correu.</p>
		<p>Et tindrem al corrent de totes les activitats que duem a terme.</p>
		<p>Moltes gràcies pel teu interès!</p>
		<?php else: ?>
		<h4><?php echo __('Vols rebre informació de totes les nostres activitats?') ?></h4>
		<?php if ($sf_user->hasFlash('error')): ?>
		<p style="color:red"><?php echo $sf_user->getFlash('error'); ?></p>
		<?php endif ?>
		<form action="<?php echo url_for('contacte_ok') ?>" method="post">
			<p><label><?php echo __('Nom') ?></label> <input type="text" name="nom" /></p>
			<p><label><?php echo __('Adreça de correu electrònic') ?></label> <input type="text" name="mail" /></p>
			<p><label><?php echo __('Com ens has conegut?') ?></label> <textarea name="conegut"></textarea></p>
			<p><input type="submit" value="<?php echo __('enviar') ?>" /></p>
		</form>
		<?php endif ?>
		
	<script type="text/javascript"><!--
	var map = null;
	var carregat_mapa = false;
	var carregat_punts = false;
	var punt = null;
//    $(window).load(function(){  carrega(); });
    $.getScript("http://maps.google.com/maps/api/js?sensor=true&region=nz&async=2&callback=carrega", function () {});

	function carrega() {
        var myLatlng = new google.maps.LatLng(41.975335,2.796738);
		var mapOptions = {
		  zoom: 12,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	    map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
		var marker = new google.maps.Marker({
			position: myLatlng, 
			map: map,
			title:"Khan cartrö"
		});   
	}
--></script>
