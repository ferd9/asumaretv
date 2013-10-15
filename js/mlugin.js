tinymce.PluginManager.add('mlugin', function(editor, url) {
    // Add a button that opens a window
    

    // Adds a menu item to the tools menu
    editor.addMenuItem('mlugin', {
        text: 'Example plugin',
        context: 'tools',
        onclick: function() {
            // Open window with a specific url
            editor.windowManager.open({
                title: 'TinyMCE site',
                url: 'http://www.tinymce.com',
                width: 800,
                height: 600,
                buttons: [{
                    text: 'Close',
                    onclick: 'close'
                }]
            });
        }
    });
});


