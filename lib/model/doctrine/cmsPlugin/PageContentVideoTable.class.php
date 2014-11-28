<?php


class PageContentVideoTable extends PluginPageContentVideoTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PageContentVideo');
    }
}