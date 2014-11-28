[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="sf_admin_container">
  <h1 class="titulo">[?php echo <?php echo $this->getI18NString('new.title') ?> ?]</h1>

  [?php if ($configuration->getNewHelp() != '') : ?]
				<div class="derecha">
					<div class="derecha_frame">
						[?php $h = $configuration->geNewHelp(); $h = str_replace('&gt;','>',$h); $h = str_replace('&lt;','<',$h);
						echo __($h, array(), '<?php echo $this->getI18nCatalogue() ?>'); ?]
					</div>
				</div>
  [?php endif ?]
  
				<div class="izquierda">

  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <div id="sf_admin_header">
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
  </div>

  <div id="sf_admin_content">
    [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </div>

  <div id="sf_admin_footer">
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
  </div>
</div>

				</div>