<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sfValidatorFileImage
 *
 * @author gemma
 */
class MySfValidatorFileImage extends MySfValidatorFile {
    protected function configure($options = array(), $messages = array())

  {
    $this->addOption('min_size_x');
    $this->addOption('max_size_x');
    $this->addOption('min_size_y');
    $this->addOption('max_size_y');
    $this->addOption('exact_size_x');
    $this->addOption('exact_size_y');

    $this->addOption('mime_types' , 'web_images');

    $this->addOption('old_src');


    /* messages d'erreur pour les dimensions*/

    $this->addMessage('min_size_x', 'L\'imatge no és prou ample (mínim %min_size_x% píxels).');
    $this->addMessage('max_size_x', 'L\'imatge és massa ample (màxim %max_size_x% píxels).');
    $this->addMessage('min_size_y', 'L\'imatge no és prou alta (mínim %min_size_y% píxels).');
    $this->addMessage('max_size_y', 'L\'imatge és massa alta (màxim %max_size_y% píxels).');
    $this->addMessage('exact_size_x', 'L\'imatge ha de fer %exact_size_x% píxels d\'ample i en fa %size_x%.');
    $this->addMessage('exact_size_y', 'L\'imatge ha de fer %exact_size_y% píxels d\'alt.');
    /* messages d'erreur sur le type de l'image */

    $this->addMessage('mime_types', 'tipus de fitxer invàlid (%mime_type%). El fitxer no és una imatge.');

    $this->addMessage('filename', 'Ja hi ha un altre fitxer amb aquest nom (%filename%).');

    /* on appelle le configure() parent pour l'utiliser sur la validation de fichier */

    parent::configure($options, $messages);
    $this->setOption('validated_file_class','MySfValidatedFileImage');


  }

protected function doClean($value)

  {
    $validatedFile = parent::doClean($value);

    $size = getimagesize($validatedFile->getTempName());

    if ($this->hasOption('exact_size_x') && $this->getOption('exact_size_x') != (int) $size[0])
    {
      throw new sfValidatorError($this, 'exact_size_x', array('exact_size_x' => $this->getOption('exact_size_x'), 'size_x' => (int) $size[0]));
    }
    if ($this->hasOption('max_size_x') && $this->getOption('max_size_x') < (int) $size[0])
    {
      throw new sfValidatorError($this, 'max_size_x', array('max_size_x' => $this->getOption('max_size_x'), 'size_x' => (int) $size[0]));
    }
    if ($this->hasOption('max_size_y') && $this->getOption('max_size_y') < (int) $size[1])
    {
      throw new sfValidatorError($this, 'max_size_y', array('max_size_y' => $this->getOption('max_size_y'), 'size_y' => (int) $size[0]));
    }
    return $validatedFile;
  }
}
?>
