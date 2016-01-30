$(document).ready(function () {

	// i_search_form
	$('.i_search_form').submit(function(){
		$('.i_search_q').val($.trim($('.i_search_q').val()));
	});


	// i_fork_rate
	$('.i_fork_rate').each(function () {
		var $this = $(this);
		if ($this.text() > 1.0)
			$this.css('color', 'green');
		else
			$this.css('color', 'red');
	});
	
	// w_event_setting
	var w_event_setting_changed = false; // Временно
	$('#w_event_setting').on('show.bs.modal', function(event) {
		var $this = $(this);
		var $btn = $(event.relatedTarget);
		
		$this.find('.w_event_setting_i_label_span').text($btn.data('label'));
		$this.find('.w_event_setting_i_label_date').text($btn.data('event_date'));
		localeDates($this.find('.w_event_setting_i_label_date'));
		$this.find('.w_event_setting_b_search_q').val($btn.data('label'));
		
		$this.data('pk', $btn.data('pk'));
		
		if($('.pk_cevent_'+$('#w_event_setting').data('pk')).first().hasClass('b_event_hidden')){
			$this.find('.w_event_setting_i_show').show();
			$this.find('.w_event_setting_i_hide').hide();
		}else{
			$this.find('.w_event_setting_i_show').hide();
			$this.find('.w_event_setting_i_hide').show();
		}
		
		w_event_setting_search_events();
	});
	
	$('.w_event_setting_i_show').click(function(){
		$.ajax({
			url: '/event/show',
			data: {id:$('#w_event_setting').data('pk')},
			success: function(){
				$('.pk_cevent_'+$('#w_event_setting').data('pk')).removeClass('b_event_hidden');
				$('.w_event_setting_i_show').hide();
				$('.w_event_setting_i_hide').show();
			}
		});
	});
	
	$('.w_event_setting_i_hide').click(function(){
		$.ajax({
			url: '/event/hide',
			data: {id:$('#w_event_setting').data('pk')},
			success: function(){
				$('.pk_cevent_'+$('#w_event_setting').data('pk')).addClass('b_event_hidden');
				$('.w_event_setting_i_show').show();
				$('.w_event_setting_i_hide').hide();
			}
		});
	});
	
	$('.w_event_setting_b_search').click(function(){
		w_event_setting_search_events();
	});
	
	function w_event_setting_search_events(){
		var $modal = $('#w_event_setting');
		var $tbody = $modal.find('table tbody');
		$tbody.empty();
		$.ajax({
			url: '/event/search',
			data: {
				q: $.trim($modal.find('.w_event_setting_b_search_q').val()),
				event_id: $modal.data('pk'),
			},
			success: function(response){
				for(var i in response.list){
					var event = response.list[i];
					var $tr = $($('.template_event_tr').html());
					$tr.addClass(SRCTYPE_CLASS[event.src_type]);
					$tr.data('pk', event.id);
					$tr.find('.date').html(event.date);
					localeDates($tr.find('.date'));
					$tr.find('.src').html(SRCTYPE_STRINGS[event.src_type]);
					$tr.find('.teams').html(event.team_home+' - '+event.team_away);
					if(event.enabled == 0) $tr.find('.status').html("Не активен");
					if(event.islive == 0) $tr.find('.m_event_islive').hide();
					if(event.event_id == $modal.data('pk')){
						$tr.find('.w_event_setting_i_event_unselect').show();
						$tr.find('.w_event_setting_i_event_select').hide();
					}else{
						$tr.find('.w_event_setting_i_event_unselect').hide();
						$tr.find('.w_event_setting_i_event_select').show();
					}
					$tbody.append($tr);
				}
				$('.w_event_setting_i_event_select').click(function(){
					w_event_setting_changed = true;
					var $this = $(this);
					var $tr = $this.parents('tr');
					$.ajax({
						url: '/event/link',
						data: {
							id: $tr.data('pk'),
							event_id: $('#w_event_setting').data('pk'),
						},
						success: function(){
							$tr.find('.w_event_setting_i_event_unselect').show();
							$tr.find('.w_event_setting_i_event_select').hide();
						}
					});
				});
				$('.w_event_setting_i_event_unselect').click(function(){
					w_event_setting_changed = true;
					var $this = $(this);
					var $tr = $this.parents('tr');
					$.ajax({
						url: '/event/link',
						data: {
							id: $tr.data('pk'),
						},
						success: function(){
							$tr.find('.w_event_setting_i_event_unselect').hide();
							$tr.find('.w_event_setting_i_event_select').show();
						}
					});
				});
			},
		});
	}
	
	$('.w_event_setting_i_close').click(function(){
		if(w_event_setting_changed) location.reload();
	});
	
	// b_event_hide
	$('.b_event_hide').click(function () {
		var $this = $(this);
		var $cevent = $this.parents('.b_cevent');
		var $btn_show = $cevent.find('.b_event_show');
		$.ajax({
			url: '/event/' + $cevent.data('pk') + '/hide',
			success: function () {
				$cevent.addClass('b_event_hidden');
				var $cur = $cevent;
				while (!$cur.next().hasClass('b_cevent')) {
					$cur = $cur.next();
					$cur.addClass('b_event_hidden');
				}
				$this.hide();
				$btn_show.show();
			}
		});
	});

	// b_event_show
	$('.b_event_show').click(function () {
		var $this = $(this);
		var $cevent = $this.parents('.b_cevent');
		var $btn_hide = $cevent.find('.b_event_hide');
		$.ajax({
			url: '/event/' + $cevent.data('pk') + '/show',
			success: function () {
				$cevent.removeClass('b_event_hidden');
				var $cur = $cevent;
				while (!$cur.next().hasClass('b_cevent')) {
					$cur = $cur.next();
					$cur.removeClass('b_event_hidden');
				}
				$this.hide();
				$btn_hide.show();
			}
		});
	});
	
	

});