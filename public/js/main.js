



function localeDates($obj){
	var $dateObjs = $obj ? $obj : $('.js_locale_dates');
	$dateObjs.each(function(){
		var $this = $(this);
		var dateString = $this.html()+' UTC';
		var fdateString = dateString.replace(/-/g,"/");
		var date = new Date(fdateString);
		$this.text(date.format('dd.mm.yyyy HH:MM'));
		$this.removeClass('js_locale_dates');
	});
}

function localeTime($obj){
	var $dateObjs = $obj ? $obj.find('.js_locale_time') : $('.js_locale_time');
	$dateObjs.each(function(){
		var $this = $(this);
		var dateString = $this.html()+' UTC';
		var fdateString = dateString.replace(/-/g,"/");
		var date = new Date(fdateString);
		$this.text(date.format('HH:MM:ss'));
		$this.removeClass('js_locale_time');
	});
}

function update_header(response){
	$('.events_updated').html(response.events_updated);
	$('.events_updated').addClass('js_locale_time');
	localeTime();
}



$(document).ajaxStart(function(){
	$(".loading-indicator").show();
}).ajaxStop(function(){
	$(".loading-indicator").hide();
});

$(document).ready(function(){
	
	localeDates();
	localeTime();
	
//	$('.js_editable').editable();

});





