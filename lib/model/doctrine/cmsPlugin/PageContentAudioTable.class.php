<?php


class PageContentAudioTable extends PluginPageContentAudioTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PageContentAudio');
    }
}