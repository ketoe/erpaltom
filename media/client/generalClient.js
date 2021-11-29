$(document).ready(function () {
  

	$(document).ready(function(){
    /*$('.weekBorder').tooltip();*/

    $('.print-button').click(function () {
    	window.print();
    })

    $('.weekBorder[lack=1]').css("background","Red");
    $('.linkOrder[monter=1]').append('<div class="iconMonter"><img src="../media/images/monter.png"></div>');


	$('.selectYearLack').change(function () {
		var year = Number($(this).val());
		window.location = "/Lack/index/"+year;
	});


});

  
});
