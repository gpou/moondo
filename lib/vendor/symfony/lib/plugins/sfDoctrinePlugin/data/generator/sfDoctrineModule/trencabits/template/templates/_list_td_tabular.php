[?php $cols = $sf_data->getRaw('columns') ?]
<?php foreach ($this->configuration->getValue('list.display') as $name => $field):
	$is_array = false;
	foreach($this->configuration->getListColumnsGroups() as $k=>$group) {
		foreach($group['columns'] as $c) {
			if ($c==$name) $is_array = isset($group['is_array']) && $group['is_array'];
		}
	}
?>
[?php if (in_array('<?php echo $name ?>',$cols)): ?]
<?php if ($is_array): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
<td class="sf_admin_%s sf_admin_list_td_%s">
	<table class="sf_admin_list_subcolumns"><tr><td>
  [?php echo str_replace("\n","</td></tr><tr><td>",%s) ?]
    </td></tr></table>
</td>

EOF
, strtolower($field->getType()), $name, $this->renderField($field)), $field->getConfig()) ?>
<?php else: ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
<td class="sf_admin_%s sf_admin_list_td_%s">
  [?php echo nl2br(%s) ?]
</td>

EOF
, strtolower($field->getType()), $name, $this->renderField($field)), $field->getConfig()) ?>
<?php endif ?>
[?php endif; ?]
<?php endforeach; ?>
