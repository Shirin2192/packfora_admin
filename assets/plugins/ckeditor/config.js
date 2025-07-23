/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] },
		{ name: 'elements', groups: [ 'elements' ] },
		{ name: 'attributes', groups: [ 'attributes' ] },
		{ name: 'classes', groups: [ 'classes' ] },
		{ name: 'section', groups: [ 'section' ] },
		{ name: 'image', groups: [ 'image' ] },
		{ name: 'i', groups: [ 'i' ] },
		{ name: 'color-part', groups: [ 'color-part' ] }

	];

	config.removeButtons = 'About,Maximize,Flash,Smiley,SpecialChar,PageBreak,Iframe,Anchor,Language,BidiRtl,BidiLtr,CreateDiv,Subscript,Superscript,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Save,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,SelectAll,ShowBlocks';
	config.language = 'en';
	config.uiColor = '#ffffff';
	config.toolbarCanCollapse = true;
	config.allowedContent = true;

};
