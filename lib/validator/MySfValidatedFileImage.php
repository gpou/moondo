<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoticiaImageValidatedFile
 *
 * @author gemma
 */
class MySfValidatedFileImage extends MySfValidatedFile {
/*
  public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777) {
      $img = parent::save();
      $img2 = $this->path.'p'.$img;
      $thumbnail = new sfThumbnail(null, 150, true, true, 85, 'sfGDAdapter');
      $thumbnail->loadFile($this->getTempName());
      $thumbnail->save($img2, 'image/jpeg');
      chmod($img2, $fileMode);
      return ($img);
  }
*/
}

?>
