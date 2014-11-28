<?php


class PageContentImageTable extends PluginPageContentImageTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PageContentImage');
    }
}