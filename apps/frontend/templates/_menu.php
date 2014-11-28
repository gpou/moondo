<?php 
$moduleName = sfContext::getInstance()->getRequest()->getParameter('module');
$actionName = sfContext::getInstance()->getActionName(); 
?>

<?php if(sfConfig::get('apartat')!='4mono'): ?>
		<ul id="menu_moondo">
			<li><h1><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(45)->slug)) ?>" title="<?php echo PageTable::getPage(45)->titre ?>"><img src="/images/khancartro.png" class="png24" alt="<?php echo PageTable::getPage(45)->titre ?>" width="130" height="147" /></a></h1></li>
		</ul>
		
		<ul id="menu" class="png24">

		<?php if ($moduleName=='espectacles' && sfConfig::get('apartat')=='espectacles'): ?>
			<li class="actiu"><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(49)->slug)); ?>" title="<?php echo PageTable::getPage(49)->titre ?>"><?php echo PageTable::getPage(49)->titre ?></a>
<?php include_slot('submenu'); ?>
			</li>
		<?php else: ?>
			<li><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(49)->slug)) ?>" title="<?php echo PageTable::getPage(49)->titre ?>"><?php echo PageTable::getPage(49)->titre ?></a></li>
		<?php endif ?>

		<?php if ($moduleName=='espectacles' && sfConfig::get('apartat')=='serveis'): ?>
			<li class="actiu"><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(61)->slug)) ?>" title="<?php echo PageTable::getPage(61)->titre ?>"><?php echo PageTable::getPage(61)->titre ?></a>
<?php include_slot('submenu'); ?>
			</li>
		<?php else: ?>
			<li><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(61)->slug)) ?>" title="<?php echo PageTable::getPage(61)->titre ?>"><?php echo PageTable::getPage(61)->titre ?></a></li>
		<?php endif ?>

		<?php if ($moduleName=='espectacles' && sfConfig::get('apartat')=='formacio'): ?>
			<li class="actiu"><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(72)->slug)) ?>" title="<?php echo PageTable::getPage(72)->titre ?>"><?php echo PageTable::getPage(72)->titre ?></a>
<?php include_slot('submenu'); ?>
			</li>
		<?php else: ?>
			<li><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(72)->slug)) ?>" title="<?php echo PageTable::getPage(72)->titre ?>"><?php echo PageTable::getPage(72)->titre ?></a></li>
		<?php endif ?>

		<?php if ($moduleName=='espectacles' && sfConfig::get('apartat')=='colaboradors'): ?>
			<li class="actiu"><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(46)->slug)) ?>" title="<?php echo PageTable::getPage(46)->titre ?>"><?php echo PageTable::getPage(46)->titre ?></a>
<?php include_slot('submenu'); ?>
			</li>
		<?php else: ?>
			<li><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(46)->slug)) ?>" title="<?php echo PageTable::getPage(46)->titre ?>"><?php echo PageTable::getPage(46)->titre ?></a></li>
		<?php endif ?>

		<?php /*if ($moduleName=='agenda'): ?>
			<li class="actiu"><a href="<?php echo url_for('agenda') ?>" title="<?php echo __('Agenda') ?>"><?php echo __('Agenda') ?></a>
				<ul class="submenu">
					<li><a href="<?php echo url_for('agenda') ?>" title="<?php echo __('Calendari') ?>"><?php echo __('Calendari') ?></a></li>
					<li><a href="<?php echo url_for('agenda_historic') ?>" title="<?php echo __('Històric') ?>"><?php echo __('Històric') ?></a></li>
				</ul>
			</li>
		<?php else: ?>
			<li><a href="<?php echo url_for('agenda') ?>" title="<?php echo __('Agenda') ?>"><?php echo __('Agenda') ?></a></li>
		<?php endif*/ ?>

		<?php if ($moduleName=='contacte'): ?>
			<li class="actiu"><a href="<?php echo url_for('contacte') ?>" title="<?php echo __('Contacte') ?>"><?php echo __('Contacte') ?></a></li>
		<?php else: ?>
			<li><a href="<?php echo url_for('contacte') ?>" title="<?php echo __('Contacte') ?>"><?php echo __('Contacte') ?></a></li>
		<?php endif ?>

		</ul>
		<div id="menu_baix" class="png24">
			<a href="<?php echo PageTable::getPage(62)->getUrl(); ?>" title="<?php echo PageTable::getPage(62)->titre ?>"><img src="/images/escoles_<?php echo $sf_user->getCulture() ?>.png" alt="<?php echo PageTable::getPage(62)->titre ?>"  class="png24" /></a>
		</div>
		<div id="menu_mono" class="png24">
			<a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(120)->slug)); ?>" title="<?php echo PageTable::getPage(120)->titre ?>"><img src="/images/4mono_estudi.png" alt="<?php echo PageTable::getPage(120)->titre ?>"  class="png24" width="160" height="120" /></a>
		</div>
<?php else: ?>

		<ul id="menu_moondo">
			<li><h1><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(120)->slug)); ?>" title="<?php echo PageTable::getPage(120)->titre ?>"><img src="/images/4mono_estudi2.png" class="png24" alt="<?php echo PageTable::getPage(120)->titre ?>" width="160" height="110" /></a></h1></li>
		</ul>
		<ul id="menu" class="png24">

			<li class="actiu"><a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(120)->slug)); ?>" title="<?php echo PageTable::getPage(120)->titre ?>"><?php echo PageTable::getPage(120)->titre ?></a>
<?php include_slot('submenu'); ?>
			</li>
		</ul>
		<div id="menu_baix_petit" class="png24">&nbsp;</div>
		<div id="menu_mono" class="png24">
			<a href="<?php echo url_for('espectacles',array('slug'=>PageTable::getPage(45)->slug)); ?>" title="<?php echo PageTable::getPage(45)->titre ?>"><img src="/images/khancartro.png" alt="<?php echo PageTable::getPage(45)->titre ?>"  class="png24"  width="130" height="147" /></a>
		</div>


<?php endif; ?>
