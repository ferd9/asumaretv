
tinymce.PluginManager.add('youtube', function(editor, url) {
	
	function jbBox() {
		editor.windowManager.open({
			title: 'Video Youtubbe',
			file : url + '/youtube-v4.htm',
			width : 450,
			height: 280,
			buttons: [
			{
				text: 'Close',
				onclick: 'close'
			}]
		});
	}
	
	// Add a button that opens a window
	editor.addButton('youtube', {
		tooltip: 'Insertar Video',
                image:url+'/img/youtube.gif',
		icon : false,
		//text: 'Insertar Video',
		onclick: jbBox
	});

	// Adds a menu item to the tools menu
	editor.addMenuItem('youtube', {
		text: 'Insertar Video',
                image:url+'/img/youtube.gif',
		icon : false,//'img/youtube.gif',
		context: 'Insertar Video',
		onclick: jbBox
	});
});


