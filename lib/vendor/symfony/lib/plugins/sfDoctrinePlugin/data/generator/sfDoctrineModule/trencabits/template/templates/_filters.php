[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]
[?php $done_columns = array() ?]

<a href="" class="sf_admin_filter_button">[?php echo __('Filters', array(), 'sf_admin') ?]</a>
[?php echo link_to(__('Reset', array(), 'sf_admin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?]
<div style="display:none">
<div class="sf_admin_filter">
  <h2>[?php echo __('Filters', array(), 'sf_admin') ?]</h2>
	<ul class="sf_admin_filters_index">
	[?php foreach($configuration->getListFiltersGroups() as $k=>$group): ?]
		<li><a href="">[?php echo $group['label'] ?]</a></li>
	[?php endforeach ?]
	</ul>
  <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" method="post">
	<div class="sf_admin_filters_groups">
    [?php if ($form->hasGlobalErrors()): ?]
      [?php echo $form->renderGlobalErrors() ?]
    [?php endif; ?]
    [?php echo $form->renderHiddenFields() ?]
    [?php foreach($configuration->getListFiltersGroups() as $k=>$group): ?]
	  [?php $group_columns = array(); foreach($group['columns'] as $col) $group_columns[$col] = true; ?]
	  <div class="sf_admin_filters_group">
      <h4>[?php echo $group['label'] ?]</h4>
      <table cellspacing="0">
        <tbody>
          [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
		    [?php if (($p=strpos($name,"."))!==FALSE) {
			  $form2 = $form[substr($name,0,$p)];
			  $name2 = substr($name,$p+1);
			  if (($p=strpos($name2,"."))!==FALSE) {
			    $form2 = $form2[substr($name2,0,$p)];
			    $name2 = substr($name2,$p+1);
			  }
			} else { $form2 = $form; $name2 = $name; }
			?]
		    [?php if (isset($group_columns[$name])): $done_columns[$name]=true; ?]
            [?php if ((isset($form2[$name2]) && $form2[$name2]->isHidden()) || (!isset($form2[$name2]) && $field->isReal())) continue ?]
              [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
                'name'       => $name2,
                'attributes' => $field->getConfig('attributes', array()),
                'label'      => $field->getConfig('label'),
                'help'       => $field->getConfig('help'),
                'form'       => $form2,
                'field'      => $field,
                'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
              )) ?]
            [?php endif ?]
          [?php endforeach; ?]
        </tbody>
      </table>
	  [?php foreach($group_columns as $n=>$c): if (!isset($done_columns[$n])) echo '<br />'.$n; endforeach; ?]
	  </div>
      [?php endforeach ?]
	</div>
    <p>
	    [?php echo link_to(__('Reset', array(), 'sf_admin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?]
        <input type="submit" value="[?php echo __('Filter', array(), 'sf_admin') ?]" />
	</p>
  </form>
</div>
</div>
<script type="text/javascript"><!--
	var filter = null;
	var filter_index = null;
	$(document).ready(function() {
		$(".sf_admin_filters_group").hide();
		filter = $(".sf_admin_filters_groups div:eq(0)");
		filter_index = $(".sf_admin_filters_index li:eq(0)");
		filter.show();
		filter_index.addClass('actiu');
		$(".sf_admin_filters_index a").click(function() {
			var i=$(".sf_admin_filters_index a").index($(this));
			if (filter != null) {
				filter.hide();
				filter_index.removeClass('actiu');
			}
			filter = $(".sf_admin_filters_groups div:eq("+i+")");
			filter_index = $(this).parent();
			filter_index.addClass('actiu');
			filter.show();
			return false;
		});
		$(".sf_admin_filter_button").colorbox({width:"75%", height:"90%", inline:true, href:".sf_admin_filter"});
	});
--></script>
