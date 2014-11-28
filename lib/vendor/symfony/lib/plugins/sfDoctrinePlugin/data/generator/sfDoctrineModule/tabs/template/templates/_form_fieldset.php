[?php use_helper('szTab'); ?]
[?php
$some_field = false;
foreach ($fields as $name => $field) {
	if ($field->isPartial()) {
		$some_field = true;
	}
	if (isset($form[$name])) {
		$some_field = true;
		if ($form[$name] instanceof sfFormFieldSchema) {
			addtab(__($name, array(), 'messages'));
			$a = $field->getConfig('attributes', array());
  			echo $form[$name]->renderError();
			echo $form[$name]->render($a instanceof sfOutputEscaper ? $a->getRawValue() : $a);
			if ($field->getConfig('help')): ?]
						<div class="help">[?php echo __($field->getConfig('help'), array(), 'messages') ?]</div>
			[?php elseif ($help = $form[$name]->renderHelp()): ?]
						<div class="help">[?php echo $field->getConfig('help') ?]</div>
			[?php endif;
			end_tab();
			return;
		}
		break;
	}
}
if ($some_field): ?]
  [?php addtab(__(('NONE' != $fieldset)?$fieldset:'Basic', array(), '<?php echo $this->getI18nCatalogue() ?>')); ?]

	<table class="tabletab">
		<tbody>
	  [?php foreach ($fields as $name => $field): ?]
		[?php if ($field->isPartial()): ?]
		  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, '<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'attributes' => $field->getConfig('attributes', array()))) ?]
		[?php elseif ($field->isComponent()): ?>
		  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, '<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'attributes' => $field->getConfig('attributes', array()))) ?]
		[?php else: ?]
			[?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
			[?php include_partial('<?php echo $this->getModuleName() ?>/form_field', array(
			  'name'       => $name,
			  'attributes' => $field->getConfig('attributes', array()),
			  'label'      => $field->getConfig('label'),
			  'help'       => $field->getConfig('help'),
			  'form'       => $form,
			  'field'      => $field,
			  'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
			)) ?]
		[?php endif ?]
	  [?php endforeach; ?]
		</tbody>
	</table>
  [?php end_tab(); ?]

[?php endif; ?]