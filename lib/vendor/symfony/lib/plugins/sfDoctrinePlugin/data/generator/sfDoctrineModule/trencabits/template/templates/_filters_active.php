[?php 
$active = $form->getActiveFilters();
$active2 = array();
foreach($configuration->getListFiltersGroups() as $k=>$group) {
	$group_columns = array(); 
	foreach($group['columns'] as $col) $group_columns[$col] = true;
    foreach ($configuration->getFormFilterFields($form) as $name => $field) {
		if (($p=strpos($name,"."))!==FALSE) {
			$form2 = $form[substr($name,0,$p)];
			$name2 = substr($name,$p+1);
			if (($p=strpos($name2,"."))!==FALSE) {
			  $form2 = $form2[substr($name2,0,$p)];
			  $name2 = substr($name2,$p+1);
			}
		} else { $form2 = $form; $name2 = $name; }
		if (isset($group_columns[$name]) && isset($active[$name])) {
			if (!isset($active2[$k])) $active2[$k] = array('label'=>$group['label'],'columns'=>array());
			$active2[$k]['columns'][] = array('label'=>$form2[$name2]->renderLabel($field->getConfig('label')), 'value'=>$active[$name]);
		}
	}
}
if (sizeof($active2)>0): ?]
<div class="sf_admin_active_filters">
	<h3>FILTRES ACTIUS :</h3>
	[?php foreach($active2 as $n=>$ac): ?]
	  <div class="sf_admin_active_filters_group">
        <h4>[?php echo $ac['label'] ?]</h4>
		[?php foreach($ac['columns'] as $a): ?]
		<p>[?php echo $a['label'] ?] : [?php echo($a['value']) ?]</p>
		[?php endforeach ?]
	  </div>
	[?php endforeach ?]
	<p style="height:1px;font-size:1px;line-height:1px;clear:both;">&nbsp;</p>
</div>
[?php endif ?]