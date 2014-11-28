<?php

 /**
 * sfWidgetFormYouTube represents a selector of a YouTube list.
 *
 * @author     Trencabits
 */
class sfWidgetFormSoundCloud extends sfWidgetFormChoice
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
	require_once 'Soundcloud/Soundcloud.php';
	$soundcloud = new Services_Soundcloud('7189c29b998e21915365cedbe7290af7','f158459abf0a31ad0958189902befd7a');
	try {
		$tracks = json_decode($soundcloud->get('users/4253100/tracks'), true);
		foreach($tracks as $track) {
			$choices[$track['id']] = $track['title']; 
		}
	} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
		exit($e->getMessage());
	}

    return $choices;
  }

}
