var initStr = '文章内容';
//详情
var contentEditor = UE.getEditor('content',{ 
	toolbars: [['fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'paragraph', 'fontfamily', 'fontsize']],
	elementPathEnabled: false,
	wordCount: false,
	imagePopup: false,
	autoClearinitialContent: true,
	initialContent: initStr,
	autoHeightEnabled:false
});
contentEditor.addListener( 'ready', function () {
	
}); 