// escape html text before displaying on input text
function kodeproperty_esc_attr(text) {
  return text
	  .replace(/&/g, "&amp;")
	  .replace(/</g, "&lt;")
	  .replace(/>/g, "&gt;")
	  .replace(/"/g, "&quot;")
	  .replace(/'/g, "&#039;");
}

function kodeproperty_css_name_check(name) {
    return name.replace(/[^a-z0-9\-\_]/g, function(s) {
        var c = s.charCodeAt(0);
        if (c == 32) return '-';
        if (c >= 65 && c <= 90) return '';
        return '';
    });
}