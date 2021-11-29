$(document).ready(function () {
$(".drop").mouseover(function() {

$(this).children("ul").show(300);

});

$(".drop").mouseleave(function() {

$(this).children("ul").hide(300);

});
});