[?php use_helper('szTab'); ?]
[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

[?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>') ?]

    [?php if ($form->hasGlobalErrors()): ?]
      [?php echo $form->renderGlobalErrors() ?]
    [?php endif; ?]

	[?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
		  [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
	[?php endforeach; ?]

	[?php include_tabs(); ?]

	<table class="tableactions">
		<tbody>
			<tr>
				<td id="sf_admin_container">
				    [?php echo $form->renderHiddenFields(false) ?]
				    [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
				</td>
			</tr>
		</tbody>
	</table>

</form>
