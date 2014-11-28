<div class="sf_admin_list">
  [?php if (!$pager->getNbResults()): ?]
    <p>[?php echo __('No result', array(), 'sf_admin') ?]</p>
  [?php else: ?]
  [?php 
  $cols = $sf_data->getRaw('columns'); 
  $num_columns = 0;
  ?]
    <table class="adminlist">
      <thead>
        <tr>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
          <th style="border-right:1px solid white;"></th>
		  [?php $num_columns++ ?]
<?php endif; ?>
          [?php 
          $groups = array();
<?php foreach($this->configuration->getListColumnsGroups() as $k=>$group): ?>
          $groups['<?php echo $k ?>'] = array('label' => '<?php echo addslashes($group['label']); ?>', 'columns' => 0);
<?php	foreach($group['columns'] as $c): ?>
          if (in_array('<?php echo $c ?>',$cols)) { $groups['<?php echo $k ?>']['columns']++; $num_columns++; }
<?php	endforeach ?>
<?php endforeach ?>
          foreach($groups as $g): ?]
			[?php if ($g['columns']>0):  ?]
		  <th style="border-right:1px solid white;" colspan="[?php echo $g['columns'] ?]">[?php echo $g['label'] ?]</th>
		    [?php endif; ?]
		  [?php endforeach ?]
<?php if ($this->configuration->getValue('list.object_actions')): ?>
		  [?php $num_columns++ ?]
          <th></th>
<?php endif; ?>
		</tr>
		<tr>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
<?php endif; ?>
          [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort, 'columns' => $columns)) ?]
<?php if ($this->configuration->getValue('list.object_actions')): ?>
          <th id="sf_admin_list_th_actions">[?php echo __('Actions', array(), 'sf_admin') ?]</th>
<?php endif; ?>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="[?php echo count($columns) + <?php echo ($this->configuration->getValue('list.object_actions') ? 1 : 0) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?> ?]">
            [?php if ($pager->haveToPaginate()): ?]
              [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
            [?php endif; ?]

            [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
            [?php if ($pager->haveToPaginate()): ?]
              [?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
            [?php endif; ?]
          </th>
        </tr>
      </tfoot>
      <tbody>
        [?php 
		foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): 
			$odd = fmod(++$i, 2) ? 'odd' : 'even';
			$nc = 0;
			$add_rows = array();
?]
          <tr class="sf_admin_row [?php echo $odd ?]">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
            [?php $nc++; include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
<?php endif; ?>
			
<?php foreach ($this->configuration->getValue('list.display') as $name => $field):
	$is_array = false;
	foreach($this->configuration->getListColumnsGroups() as $k=>$group) {
		foreach($group['columns'] as $c) {
			if ($c==$name) $is_array = isset($group['is_array']) && $group['is_array'];
		}
	}
?>
[?php 
if (in_array('<?php echo $name ?>',$sf_data->getRaw('columns'))): ?]
<td class="sf_admin_<?php echo strtolower($field->getType()) ?> sf_admin_list_td_<?php echo $name ?>">
	<?php if ($is_array): ?>
	[?php 
	$v = <?php echo $this->renderField($field) ?>;
	$vv = explode("|",$v);
	<?php if ($field->getConfig('is_array',false)): ?>
	foreach($vv as $iv=>$vvv) $vv[$iv] = ($vvv!="" && $vvv!='-')?'<ul class="sf_admin_list_sublist">'.str_replace("[","<li>",str_replace("]","</li>",nl2br($vvv))).'</ul>':$vvv;
	<?php else: ?>
	foreach($vv as $iv=>$vvv) $vv[$iv] = nl2br($vvv);
	<?php endif ?>
	if (sizeof($vv)>1) {
		for($r=1;$r<sizeof($vv); $r++) {
			if ($r>sizeof($add_rows)) $add_rows[] = array();
			$add_rows[$r-1][$nc] = $vv[$r];
		}
	} 
	echo $vv[0];
	?]
	<?php else: ?>
	<?php if ($field->isLink()): $field->setLink(false); ?>
	<a href="[?php echo $helper->getBaseUrlForEdit($<?php echo $this->getSingularName() ?>);  ?]">[?php echo <?php echo $this->renderField($field) ?>;  ?]</a>
	<?php else: ?>
  [?php echo <?php echo $this->renderField($field) ?>;  ?]
    <?php endif ?>
  <?php endif ?>
</td>
[?php $nc++; endif; ?]
<?php endforeach; ?>



<?php if ($this->configuration->getValue('list.object_actions')): ?>
            [?php $nc++; include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
<?php endif; ?>
          </tr>
		[?php foreach($add_rows as $r) : ?]
		<tr class="sf_admin_row [?php echo $odd ?]">
			[?php for ($c=0; $c<$num_columns; $c++): ?]
			<td>
				[?php if (isset($r[$c])) echo $r[$c] ?]
			</td>
			[?php endfor ?]
		</tr>
		[?php endforeach ?]
        [?php endforeach; ?]
		
      </tbody>
    </table>
  [?php endif; ?]
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
