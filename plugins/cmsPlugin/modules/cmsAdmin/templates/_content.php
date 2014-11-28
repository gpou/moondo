						<?php 
						switch($content->type): 
							case 'text': ?>
								<?php echo $content->getFormattedTextForAdmin(ESC_RAW) ?>
						<?php
							break;
							case 'images': ?>
								<?php echo $content->getFormattedText(ESC_RAW); ?>
								<?php if(count($content->getImages())>0): ?>
								<div class="imatges">
									<?php foreach($content->getImages() as $image): ?>
										<a href="<?php echo sfConfig::get('app_path_images').$image->image ?>" alt="<?php echo $image->titre ?>" rel="shadowbox[imatges];title=<?php echo $image->titre ?>"><img src="<?php echo sfConfig::get('app_path_images_petites').$image->image_small ?>" alt="<?php echo $image->titre ?>" /></a>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
						<?php
							break;
							case 'videos': ?>
								<h4><?php echo __('Vídeos') ?></h4>
								<?php echo $content->getFormattedText(ESC_RAW); ?>
								<?php if(count($content->getVideos())>0): ?>
								<div class="videos">
									<?php foreach($content->getVideos() as $video): ?>
									<h5><?php echo $video->titre ?></h5>
									<iframe width="490" height="390" src="http://www.youtube.com/embed/<?php echo $video->getUrl(ESC_RAW) ?>" frameborder="0" allowfullscreen></iframe>
									<?php endforeach; ?>
								</div>
								<?php endif ?>
						<?php
							break;
							case 'audios': ?>
								<h4><?php echo __('Audios') ?></h4>
								<?php echo $content->getFormattedText(ESC_RAW); ?>
								<?php if(count($content->getAudios())>0): ?>
								<div class="audios">
									<?php foreach($content->getAudios() as $audio): ?>
									<h5><?php echo $audio->titre ?></h5>
									<object height="81px" width="490px"> <param name="movie" value="http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F<?php echo $audio->getUrl(ESC_RAW) ?>"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" src="http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F<?php echo $audio->getUrl(ESC_RAW) ?>" type="application/x-shockwave-flash" height="81px" width="490px"></embed> </object>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
						<?php
							break;
							case 'docs': ?>
								<h4><?php echo __('Descàrregues') ?></h4>
								<?php echo $content->getFormattedText(ESC_RAW); ?>
								<?php if(count($content->getDocs())>0): ?>
								<div class="docs">
									<?php foreach($content->getDocs() as $doc): ?>
										<p><a href="<?php echo sfConfig::get('app_path_docs').$doc->url ?>" alt="<?php echo $doc->titre ?>" target="_blank"><?php echo $doc->titre?$doc->titre:$doc->url ?></a></p>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
						<?php 
							break;
							case 'links': ?>
								<p>&nbsp;</p>
								<?php echo $content->getFormattedText(ESC_RAW); ?>
								<?php if(count($content->getLinks())>0): ?>
								<div class="links">
									<?php foreach($content->getLinks() as $link): ?>
										<p><a href="<?php echo $link->url ?>" alt="<?php echo $link->titre ?>" target="_blank"><?php echo $link->titre ?></a></p>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
						<?php
							break;
							case 'submenu': ?>
								<?php echo $content->getFormattedText(ESC_RAW); ?>
								<ul class="submenu_dins">
									<?php include_partial('cmsAdmin/llista',array('page'=>$content->Page,'nivells'=>$content->submenu_levels,'nivell'=>1)); ?>

								</ul>
						<?php
							break;
							?>
						<?php endswitch; ?>
