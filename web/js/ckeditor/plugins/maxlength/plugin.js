/**
* CKEditor Max Lenth Plugin
*
*/
(function() {
    CKEDITOR.plugins.maxlength = {
};

var plugin = CKEDITOR.plugins.maxlength;

function EnsureMaxLength(evt) {
    var editor = evt.editor;

    var currentLength = editor.getData().length, maximumLength = editor.config.maxlength;

    if (editor.config.maxlength_counter)
        $('div#cke_maxlength_' + editor.name+' span').html(currentLength);
	if (currentLength >= maximumLength) $("#cke_maxlength_" + editor.name+" span").css('color','red');
	else $("#cke_maxlength_" + editor.name+" span").css('color','#60676a');


    if (currentLength >= maximumLength) {
        if (!locked) {
            // Record the last legal content.         
            editor.fire('saveSnapshot'), locked = 1;

            // Cancel the keystroke.
            evt.cancel();
        }
        else // Check after this key has effected.         
            setTimeout(function() {
                // Rollback the illegal one.
                if (editor.getData().length > maximumLength) {
                    editor.execCommand('undo');
					if (editor.config.maxlength_counter) {
						currentLength = editor.getData().length;
						$('div#cke_maxlength_' + editor.name+' span').html(currentLength);
						if (currentLength >= maximumLength) $("#cke_maxlength_" + editor.name+" span").css('color','red');
						else $("#cke_maxlength_" + editor.name+" span").css('color','#60676a');
					}
                }
                else {
                    locked = 0;

                    if (editor.config.maxlength_counter) {
                        $('div#cke_maxlength_' + editor.name+' span').html(currentLength);
						if (currentLength >= maximumLength) $("#cke_maxlength_" + editor.name+" span").css('color','red');
						else $("#cke_maxlength_" + editor.name+" span").css('color','#60676a');
					}
                }
            }, 0);
    }

}

/**
* Takes the given HTML data, replaces all its HTML tags with nothing, splits the result by spaces, 
* and outputs the array length i.e. number of words.
* 
* @param string htmlData HTML Data
* @return int Word Count
*/
function GetMaxLength(htmlData) {
    return htmlData.replace(/<(?:.|\s)*?>/g, '').split(' ').length;
}

/**
* Adds the plugin to CKEditor
*/
CKEDITOR.plugins.add('maxlength', {
    init: function(editor) {
        // Max Length value
        //editor.config.maxlength = $('input[name=' + editor.name + 'MaxLength]').val();

        if (editor.config.maxlength) {

            setTimeout(function() {
				var length = editor.getData().length;
                $('td#cke_top_' + editor.name).append('<div id="cke_maxlength_' + editor.name + '" style="display: inline-block; float: right; text-align: right; margin-top: 5px; cursor:auto; font:12px Arial,Helvetica,Tahoma,Verdana,Sans-Serif; height:auto; padding:0; text-align:left; text-decoration:none; vertical-align:baseline; white-space:nowrap; width:auto;">Characters: <span style="color: #60676a;">'+length+'</span> de '+editor.config.maxlength+'</div>');
				if (length > editor.config.maxlength) $("#cke_maxlength_" + editor.name+" span").css('color','red');
            }, 0);

            editor.on('key', EnsureMaxLength);
            editor.on('paste', EnsureMaxLength);
        }
    }
});
})();

// Plugin vars
var locked;


// Plugin options
CKEDITOR.config.maxlength_counter = true; 