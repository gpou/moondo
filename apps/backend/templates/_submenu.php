			  <ul>
				  <?php foreach(PageTable::getPage($id)->SubPages as $p): ?>
				  <li><a href="<?php echo url_for($route.'_page',array('id'=>$p->id)) ?>"><?php echo $p->titre ?></a></li>
				  <?php endforeach; ?>
			  </ul>
