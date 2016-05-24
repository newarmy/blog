var initStr = 'ddd';
//详情
var contentEditor = UE.getEditor('content',{ 
	toolbars: [['fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'paragraph', 'fontfamily', 'fontsize']],
	elementPathEnabled: false,
	wordCount: false,
	imagePopup: false,
	autoClearinitialContent: true,
	initialContent: initStr
});
contentEditor.addListener( 'ready', function () {
	
}); 