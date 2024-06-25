/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// %REMOVE_START%
	config.plugins =
		'basicstyles,' +
		'bidi,' +
		'find,' +
		'flash,' +
		'floatingspace,' +
		'font,' +
		'format,' +
		'image2,' +
		'iframe,' +
		'justify,' +
		'language,' +
		'link,' +
		'list,' +
		'liststyle,' +
		'pastetext,' +
		'resize,' +
		'smiley,' +
		'stylescombo,' +
		'tab,' +
		'table,' +
		'tableselection,' +
		'tabletools,' +
		'toolbar,' +
		'undo,' +
		'wysiwygarea';

    config.toolbar = [
    	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Subscript' ] },
    	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
    	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    	{ name: 'others', items: [ '-' ] },
    	{ name: 'links', items: [ 'Link', 'Unlink' ] },
    ];

    // Toolbar groups configuration.
    config.toolbarGroups = [
    	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    	'/',
    	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
    	{ name: 'links' },
    	'/',
    	{ name: 'styles' },
    	{ name: 'colors' },
    ];

    config.extraAllowedContent = 'img[src,alt,width,height]';
  	// Remove some buttons, provided by the standard plugins, which we don't
  	// need to have in the Standard(s) toolbar.
  	config.removeButtons = 'Underline,Subscript,Superscript';

  	// Se the most common block elements.
  	config.format_tags = 'p;h1;h2;h3;pre';

  	// Make dialogs simpler.
  	config.enterMode = CKEDITOR.ENTER_BR;
  	config.forcePasteAsPlainText = true;
  	config.removeFormatTags = 'code,del,dfn,font,ins,kbd';
  	config.skin = 'n1theme';
  	config.width = '100%';
  	config.height = '380px';
  	config.removePlugins = 'elementspath';
    //config.allowedContent = 'img[src,alt,width,height]';

    config.extraPlugins = 'imagemodal';

    //config.imageResize.maxWidth = 800;
    //config.imageResize.maxHeight = 800;
};

// %LEAVE_UNMINIFIED% %REMOVE_LINE%
