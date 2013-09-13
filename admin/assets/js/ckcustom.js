CKEDITOR.editorConfig = function( config )
{
    // Define changes to default configuration here. For example:

    config.toolbar= [
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
	{ name: 'tools', items: [ 'Maximize' ] },
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
	{ name: 'others', items: [ '-' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
	{ name: 'styles', items: [ 'Styles', 'Format' ] },
	{ name: 'about', items: [ 'About' ] }
];

};

// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.


// Toolbar groups configuration.
// config.toolbarGroups = [
// 	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
// 	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
// 	{ name: 'links' },
// 	{ name: 'insert' },
// 	{ name: 'forms' },
// 	{ name: 'tools' },
// 	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
// 	{ name: 'others' },
// 	'/',
// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
// 	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
// 	{ name: 'styles' },
// 	{ name: 'colors' },
// 	{ name: 'about' }
// ];