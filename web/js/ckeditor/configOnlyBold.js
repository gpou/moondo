/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/



CKEDITOR.editorConfig = function( config )
{
    config.language = 'fr';

    config.toolbar = 'Basic';

    config.toolbar_Basic =
    [
        ['Bold','CharCount']
    ];
	config.height = '40px';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_BR;
	config.toolbarCanCollapse = false;
	
	config.extraPlugins = 'maxlength';
	config.maxlength = '180';
	
};


