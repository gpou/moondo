<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ca" xml:lang="ca">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
	<?php include_slot('head') ?>
</head>
<body>
	<div id="tot">
		<table>
			<tr>
				<td>
					<h1><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(45)->slug)) ?>" title="<?php echo __('entrar') ?>"><img src="/images/khancartro_gran.jpg" alt="<?php echo __('Khan cartrö. Factoria artística') ?>" /></a><b><?php echo __('Khan cartrö. Factoria artística') ?></b></h1>
				</td>
				<td>
<?php echo $sf_content ?>
				</td>
			</tr>
		</table>
	</div>
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