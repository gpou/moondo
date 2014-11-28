[?php $field_labels = array(
<?php foreach($this->configuration->getValue('list.display') as $name => $field): ?>
	"<?php echo $name ?>" => '<?php echo $field->getConfig('label', '', true) ?>',
<?php endforeach ?>
); ?]

<a href="" class="sf_admin_columns_button">[?php echo __('Columns', array(), 'sf_admin') ?]</a>
<div style="display:none">
<div class="sf_admin_columns">
  <h2>[?php echo __('Visible columns', array(), 'sf_admin') ?]</h2>
  <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'columns')) ?]" method="post">
	<ul class="sf_admin_columns_index">
	[?php foreach($configuration->getListColumnsGroups() as $k=>$group): ?]
		<li><a href="">[?php echo $group['label'] ?]</a></li>
	[?php endforeach ?]
	</ul>
	<div class="sf_admin_columns_groups">
	[?php $cols = $sf_data->getRaw('columns') ?]
	[?php $done_columns = array(); ?]
	[?php foreach($configuration->getListColumnsGroups() as $k=>$group): ?]
		<div class="sf_admin_columns_group">
			<h4>[?php echo $group['label'] ?]</h4>
		[?php foreach($group['columns'] as $name): 
			$required = isset($group['required'])&&($group['required']);
			if (substr($name,0,1)=='_') $name = substr($name,1); ?]
			[?php $done_columns[] = $name; ?]
			<input type="checkbox" [?php if ($required) echo ' readonly="readonly"' ?] name="columns[[?php echo $name ?]]"[?php if (in_array($name, $cols) || $required) echo ' checked' ?] /> [?php echo $field_labels[$name] ?]<br />
		[?php endforeach ?]
		</div>
	[?php endforeach ?]
    [?php 
	$some = false;
	foreach ($configuration->getListDisplay() as $name) {
		if (substr($name,0,1)=='_') $name = substr($name,1);
		if (!in_array($name,$done_columns)) $some = true;
	} 
	?]
	[?php if ($some): ?]
		<div class="sf_admin_columns_group">
			<h4>Altres</h4>
		[?php foreach ($configuration->getListDisplay() as $name): 
			if (substr($name,0,1)=='_') $name = substr($name,1); ?]
			[?php if (!in_array($name,$done_columns)): ?]
				<input type="checkbox" name="columns[[?php echo $name ?]]"[?php if (in_array($name, $cols)) echo ' checked' ?] /> [?php echo $name ?]<br />
			[?php endif ?]
		[?php endforeach; ?]
		</div>
	[?php endif ?]
	</div>
	<p><input type="submit" value="[?php echo __('Show', array(), 'sf_admin') ?]" /></p>
  </form>
</div>
</div>
<script type="text/javascript"><!--
	var group = null;
	var group_index = null;
	$(document).ready(function() {
		$(".sf_admin_columns_group").hide();
		group = $(".sf_admin_columns_groups div:eq(0)");
		group_index = $(".sf_admin_columns_index li:eq(0)");
		group.show();
		group_index.addClass('actiu');
		$(".sf_admin_columns_index a").click(function() {
			var i=$(".sf_admin_columns_index a").index($(this));
			if (group != null) {
				group.hide();
				group_index.removeClass('actiu');
			}
			group = $(".sf_admin_columns_groups div:eq("+i+")");
			group_index = $(this).parent();
			group_index.addClass('actiu');
			group.show();
			return false;
		});
		$(".sf_admin_columns_button").colorbox({width:"75%", height:"85%", inline:true, href:".sf_admin_columns"});
	});
--></script>
