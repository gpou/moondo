<?php


class PageContentLinkTable extends PluginPageContentLinkTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PageContentLink');
    }
}