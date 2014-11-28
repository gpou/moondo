/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
/*
CKEDITOR.stylesSet.add( 'cms_styles',
[
    // Block-level styles
    { name : 'Titre', element : 'p', styles : { 'class' : 'titre_2' } },
    { name : 'Actualité' , element : 'p', styles : { 'class' : 'actualite' } },
    { name : 'Actualité Lien' , element : 'p', styles : { 'class' : 'actualite_more' } },
    { name : 'Couleur' , element : 'p', styles : { 'class' : 'color_fosc' } },
]);
*/
CKEDITOR.editorConfig = function( config )
{
    config.language = 'ca';

    config.toolbar = 'Cms';

    config.toolbar_Cms =
    [
		['Format', 'Bold','Italic','Underline'],
		['Link','Unlink','Anchor'],
		['NumberedList','BulletedList','-','Outdent','Indent'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Source']
    ];
	
	config.width = '550px';
	//config.height = '200px';
	
    config.pasteFromWordRemoveFontStyles = true;
    config.pasteFromWordRemoveStyles = true;
	config.extraPlugins = 'autoclean';
	
	config.format_tags = 'p;h4;pre';
	//config.format_pre = { element : 'pre',attributes: {} };
	
	config.contentsCss = '/css/ckeditor.css';
	config.linkShowAdvancedTab = false;
	
};


