CKEDITOR.plugins.add('imagemodal',
{
    init: function (editor) {
        var pluginName = 'imagemodal';
        editor.ui.addButton('Imagemodal',
            {
                label: 'Image Modal',
                command: 'OpenWindow',
                icon: CKEDITOR.plugins.getPath('imagemodal') + '/images/noimage.png'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
    window.open('/Default.aspx', 'MyWindow', 'width=800,height=700,scrollbars=no,scrolling=no,location=no,toolbar=no');
}
