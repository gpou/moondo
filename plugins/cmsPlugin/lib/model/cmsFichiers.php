<?php
class cmsFichiers {
	
	public static function fileIsUsed ($f) {
		if (PageContentTable::getInstance()->createQuery()
				->where('text LIKE \'%href="'.$f.'"%\'')
				->orWhere('text LIKE \'%src="'.$f.'"%\'')
				->execute()->count()>0) return true;
		return false;
	}
	
	public static function directoryIsUsed ($d) {
		if (PageContentTable::getInstance()->createQuery()
				->where('text LIKE \'%href="'.$d.'\/%"%\'')
				->orWhere('text LIKE \'%src="'.$d.'\/%"%\'')
				->execute()->count()>0) return true;
		return false;
	}
	
	public static function renameFile ($old, $new, $is_dir=false) {
		$old = str_replace("'","\\'",$old);
		$new = str_replace("'","\\'",$new);
		if ($is_dir) {
			$contents = PageContentTable::getInstance()->createQuery()
					->where('text LIKE \'%href="'.$old.'%"%\'')->orWhere('text LIKE \'%src="'.$old.'%"%\'')->execute();
			$slugs = array('/href=\"'.str_replace("/","\\/",$old).'\//','/src=\"'.str_replace("/","\\/",$old).'\//');
			$values = array('href="'.$new.'/','src="'.$new.'/');
		} else {
			$contents = PageContentTable::getInstance()->createQuery()
					->where('text LIKE \'%href="'.$old.'"%\'')->orWhere('text LIKE \'%src="'.$old.'"%\'')->execute();
			$slugs = array('/href=\"'.str_replace("/","\\/",$old).'"/','/src=\"'.str_replace("/","\\/",$old).'"/');
			$values = array('href="'.$new.'"','src="'.$new.'"');
		}
		foreach($contents as $c) {
			$c->text = preg_replace($slugs, $values, $c->text );
			$c->save();
		}
	}

}