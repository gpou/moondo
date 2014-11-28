<?php


class PageContentTable extends PluginPageContentTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PageContent');
    }
}