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
class MySfValidatedFile extends sfValidatedFile {

  public function generateFilename()
    {
        $nom_arxiu = $this->getOriginalName();
		$a=pathinfo($nom_arxiu);
		$e=strtolower($a["extension"]);
		$search  = array ('Á','À','É','È','Í','Ì','Ó','Ò','Ú','Ù','Ä','Ë','Ï','Ö','Ü','Â','Ê','Î','Ô','Û','Ç','á','à','é','è','í','ì','ó','ò','ú','ù','ä','ë','ï','ö','ü','â','ê','î','ô','û','ç');
		$replace = array ('A','A','E','E','I','I','O','O','U','U','A','E','I','O','U','A','E','I','O','U','C','a','a','e','e','i','i','o','o','u','u','a','e','i','o','u','a','e','i','o','u','c');
		// nom de l'arxiu
		$nom_arxiu=substr($nom_arxiu,0,-strlen($e)-1);
		$nom_arxiu=str_replace($search,$replace,$nom_arxiu);
		$nom_arxiu=preg_replace("/[^\w]/","_",$nom_arxiu);
		$nom_arxiu.=".".$e;
      return $nom_arxiu;
    }

}

?>
