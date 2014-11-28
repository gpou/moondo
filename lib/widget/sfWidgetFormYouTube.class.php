<?php

 /**
 * sfWidgetFormYouTube represents a selector of a YouTube list.
 *
 * @author     Trencabits
 */
class sfWidgetFormYouTube extends sfWidgetFormChoice
{
  public function __construct($options = array(), $attributes = array())
  {
    $options['choices'] = array();

    parent::__construct($options, $attributes);
  }
  protected function configure($options = array(), $attributes = array())
  {
	parent::configure($options, $attributes);
  }
  
  public function getChoices()
  {
    $choices = array();
	require_once 'Zend/Loader.php';
	Zend_Loader::loadClass('Zend_Gdata_YouTube');
	$youTube = new Zend_Gdata_YouTube();
	$videos = $youTube->getuserUploads('khancartro');
	foreach($videos as $video) {
		$choices[$video->getVideoId()] = $video->getVideoTitle();
	}
    return $choices;
  }

}
