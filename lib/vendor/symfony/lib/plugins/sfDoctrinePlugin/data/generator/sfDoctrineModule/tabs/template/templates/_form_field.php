[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif (isset($form[$name])): ?]
			<tr>
				<th>[?php echo $form[$name]->renderLabel($label) ?]</th>
				<td>
					[?php echo $form[$name]->renderError() ?]
					[?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
					[?php if ($help): ?]
						<div class="help">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
					[?php elseif ($help = $form[$name]->renderHelp()): ?]
						<div class="help">[?php echo $help ?]</div>
					[?php endif; ?]
				</td>
			</tr>

[?php endif; ?]
