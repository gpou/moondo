<?php


class PageContentDocTable extends PluginPageContentDocTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PageContentDoc');
    }
}