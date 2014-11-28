<?php
class MySfValidatorFile extends sfValidatorFile {
    protected function configure($options = array(), $messages = array()) {
        $this->addOption('old_src');
        parent::configure($options, $messages);
        $this->setOption('validated_file_class','MySfValidatedFile');
		$this->addMessage('mime_types', 'tipus de fitxer invàlid (%mime_type%). El fitxer no és una imatge.');
		$this->addMessage('filename', 'Ja hi ha un altre fitxer amb aquest nom (%filename%).');
    }
    protected function doClean($value) {
        $validatedFile = parent::doClean($value);
        $fname = $validatedFile->generateFilename();
        if ($fname!=$this->getOption('old_src')) {
            if (file_exists($this->getOption('path').DIRECTORY_SEPARATOR.$fname))
                throw new sfValidatorError($this, 'filename', array('filename' => $fname));
        }
        return $validatedFile;
    }
}
