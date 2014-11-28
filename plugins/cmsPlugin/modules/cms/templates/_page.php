<?php if ($page == null) return ?>

<?php if (isset($showTitle) && $showTitle): ?>
	<?php if ($page->Parent != null && $page->Parent->titre!=''): ?>
		<h2><?php echo $page->Parent->titre ?></h2>
		<h3><?php echo $page->titre ?></h3>
	<?php else: ?>
		<h2><strong><?php echo $page->titre ?></h2>
	<?php endif ?>
		<p>&nbsp;</p>
		<?php if ($page->image): ?>
		<img class="foto_pagina" src="<?php echo sfConfig::get('app_path_images_llistat').$page->image ?>" alt="<?php echo $page->titre ?>" />
		<?php endif ?>
<?php endif ?>

<?php foreach($page->getVisibleContents() as $content): ?>
<?php 
switch($content->type) {
		case 'text': ?>
			<?php echo $content->getFormattedText(ESC_RAW) ?>
		
<?php		break;
		case 'form': ?>
			<?php echo $content->getFormattedText(ESC_RAW) ?>
			<form action="<?php echo url_for('contacte_ok') ?>" method="post">
				<p><label><?php echo __('Nom') ?></label> <input type="text" name="nom" /></p>
				<p><label><?php echo __('Adreça de correu electrònic') ?></label> <input type="text" name="mail" /></p>
				<p><label><?php echo __('Com ens has conegut?') ?></label> <textarea name="conegut"></textarea></p>
				<p><input type="submit" value="<?php echo __('enviar') ?>" /></p>
			</form>
<?php		break;
		case 'images': 
			if(count($content->getImages())>0): ?>
				<div class="imatges">
					<?php echo $content->getFormattedText(ESC_RAW) ?>
					<?php foreach($content->getImages() as $image): $size=$image->getImageSize(); ?>
						<a href="<?php echo sfConfig::get('app_path_images').$image->image ?>" alt="<?php echo $image->titre ?>" rel="shadowbox[imatges];title=<?php echo $image->titre ?>"><img src="<?php echo sfConfig::get('app_path_images_petites').$image->image_small ?>" alt="<?php echo $image->titre ?>" style="width:<?php echo $size['width'] ?>px; height:<?php echo $size['height'] ?>px;" /></a>
					<?php endforeach; ?>
				</div>
			<?php 
			endif;
			break;
		case 'videos': 
			if(count($content->getVideos())>0): ?>
				<div class="videos">
					<h4><?php echo __('Vídeos') ?></h4>
					<?php echo $content->getFormattedText(ESC_RAW) ?>
					<?php foreach($content->getVideos() as $video): ?>
						<h5><?php echo $video->titre ?></h5>
						<iframe width="490" height="390" src="http://www.youtube.com/embed/<?php echo $video->getUrl(ESC_RAW) ?>" frameborder="0" allowfullscreen></iframe>
					<?php endforeach; ?>
				</div>
			<?php 
			endif;
			break;
		case 'audios': 
			if(count($content->getAudios())>0): ?>
				<div class="videos">
					<h4><?php echo __('Audios') ?></h4>
					<?php echo $content->getFormattedText(ESC_RAW) ?>
					<?php foreach($content->getAudios() as $audio): ?>
					<h5><?php echo $audio->titre ?></h5>
					<object height="81px" width="490px"> <param name="movie" value="http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F<?php echo $audio->getUrl(ESC_RAW) ?>"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" src="http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F<?php echo $audio->getUrl(ESC_RAW) ?>" type="application/x-shockwave-flash" height="81px" width="490px"></embed> </object>
					<?php endforeach; ?>
				</div>
			<?php 
			endif;
			break;
		case 'docs': 
			if(count($content->getDocs())>0): ?>
				<div class="docs">
					<h4><?php echo __('Descàrregues') ?></h4>
					<?php echo $content->getFormattedText(ESC_RAW); ?>
					<?php foreach($content->getDocs() as $doc): ?>
						<p><a href="<?php echo sfConfig::get('app_path_docs').$doc->url ?>" alt="<?php echo $doc->titre ?>" target="_blank"><?php echo $doc->titre?$doc->titre:$doc->url ?></a></p>
					<?php endforeach; ?>
				</div>
			<?php 
			endif;
			break;
		case 'links': 
			if(count($content->getLinks())>0): ?>
				<div class="links">
					<p>&nbsp;</p>
					<?php echo $content->getFormattedText(ESC_RAW) ?>
					<?php foreach($content->getLinks() as $link): ?>
						<p><a href="<?php echo $link->url ?>" alt="<?php echo $link->titre ?>" target="_blank"><?php echo $link->titre ?></a></p>
					<?php endforeach; ?>
				</div>
			<?php 
			endif;
			break;
		case 'submenu': ?>
			<?php echo $content->getFormattedText(ESC_RAW) ?>
			<ul class="submenu_dins">
				<?php include_partial('cms/llista',array('page'=>$page,'nivells'=>$content->submenu_levels,'nivell'=>1)); ?>

			</ul>
			<?php 
			break;
} ?>
		
<?php endforeach; ?>



