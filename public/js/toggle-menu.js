 var theToggle = document.getElementById('toggle-crud');

// hasClass
function hasClass(elem, className) {
	return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
// addClass
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
    	elem.className += ' ' + className;
    }
}
// removeClass
function removeClass(elem, className) {
	var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
	if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}
// toggleClass
function toggleClass(elem, className) {
	var newClass = ' ' + elem.id.replace( /[\t\r\n]/g, " " ) + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0 ) {
            newClass = newClass.replace( " " + className + " " , " " );
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
        elem.className += ' ' + className;
    }

}
function toggleMenuTd(e){
    $(".toggle-menu").removeClass('on');
    // $(".toggle-menu-list").removeClass('on');

    if($(e).hasClass('on')){
        $(e).removeClass('on');
    }
    else{
        $(".toggle-menu-td").removeClass('on');
        $(".toggle-menu-list").removeClass('on');

        toggleClass(e, 'on');        
        return false;
    }
}
function toggleMenuTable(e){
    if($(e).hasClass('on')){
        $(e).removeClass('on');
    }
    else{
        $(e).addClass('on');
    }
}
function hideMenu(){
    $(".toggle-menu").removeClass('on');
}
$(document).on('click', function (e) {
    if ($(e.target).closest(".toggle-menu").length === 0) {
        $(".toggle-menu").removeClass('on');
    }
  
});