function enable_content(){
	if($('.non-editable-content').attr('contenteditable') == 'false'){
		$('.non-editable-content').attr('contenteditable','true');
		$('.non-editable-content').css('background','#ffffff');
	}
}
function disable_content(){
	if($('.non-editable-content').attr('contenteditable') == 'true'){
		$('.non-editable-content').attr('contenteditable','false');
		$('.non-editable-content').css('background','#cccccc');	
	}
	
}
//to chnage font size
function changeSize(myfontsize){
  document.execCommand('fontSize', false, myfontsize);
}

$('[contenteditable]').on('paste', function (e) {    
    var text = '';
    if (e.clipboardData || e.originalEvent.clipboardData) {
        text = (e.originalEvent || e).clipboardData.getData('text/plain');
    } else if (window.clipboardData) {
        text = window.clipboardData.getData('Text');
    }
    // strip line breaks here...
    text = text.replace(/\r?\n|\r/g, "")
    document.execCommand('insertText', false, text);
    
    e.preventDefault();
    return false;
});