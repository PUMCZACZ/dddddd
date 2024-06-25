CKEDITOR.plugins.add('imagemodal',
{
    init: function (editor) {
        var pluginName = 'imagemodal';
        editor.ui.addButton('Imagemodal',
            {
                label: 'Image Modal',
                command: 'OpenWindow',
                //icon: CKEDITOR.plugins.getPath('imagemodal') + 'images/icon.png'
                icon: 'image'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
    //window.open('/Default.aspx', 'MyWindow', 'width=800,height=700,scrollbars=no,scrolling=no,location=no,toolbar=no');
    $('#imagemodal').modal('show')
}
