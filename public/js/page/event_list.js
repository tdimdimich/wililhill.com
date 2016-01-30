$(document).ready(function () {

	// i_search_form
	$('.i_search_form').submit(function(){
		$('.i_search_q').val($.trim($('.i_search_q').val()));
	});
	
	
	$('#w_event_link').on('show.bs.modal', function(event) {
		var $this = $(this);
		var $btn = $(event.relatedTarget);
		var $event = $btn.parents('.event');

		$this.find('.w_event_link_i_label_span').text(
			$event.find('.teams').html() + ' (' + $event.find('.date').html() + ')'
		);
		$this.data('id', $btn.data('id'));
		$this.data('event_id', $btn.data('event_id'));

		$this.find('.w_event_link_b_search_q').val($event.find('.teams').html());
		w_event_link_update_events();
	});

	$('.w_event_link_b_search').click(function(){
		w_event_link_update_events();
	});

	$('.w_event_link_i_remove').click(function(){
		var $modal = $('#w_event_link');
		var $event = $('.event_'+$modal.data('id'));
		$.ajax({
			url: '/event/'+$modal.data('id')+'/link',
			success: function(){
				$modal.find('.m_event_selected').removeClass('m_event_selected');
				$modal.data('event_id', null);
				$event.addClass('danger');
				$event.find('.b_event_link').data('event_id', null);
			},
		});
	});

	$('.w_event_link_i_reverse').click(function(){
		var $modal = $('#w_event_link');
		var $event = $('.event_'+$modal.data('id'));
		$.ajax({
			url: '/event/'+$modal.data('id')+'/reverse',
			success: function(response){
				var event = response.event;
				$modal.find('.w_event_link_i_label_span').html(event.team_home+' - '+event.team_away);
				update_event($event, event);
			},
		});
	});

	function w_event_link_update_events(){
		var $modal = $('#w_event_link');
		var $table = $modal.find('table');
		var $tbody = $table.find('tbody');
		$.ajax({
			url: '/event/searchcombine',
			data: {
				q: $modal.find('.w_event_link_b_search_q').val(),
				event_id: $modal.data('event_id'),
			},
			success: function(response){
				$tbody.empty();
				for(var i in response.list){
					var event = response.list[i];
					var $tr = $($('.template_event_tr').html());
					$tr.data('pk', event.id);
					$tr.find('.teams').html(event.team_home+' - '+event.team_away);
					$tr.find('.date').html(event.date);
					if(event.id == $modal.data('event_id'))
						$tr.addClass('m_event_selected');
					$tbody.append($tr);
				}
				localeDates($tbody);
				$modal.find('.link_event').click(function(){
					w_event_link_link_event($(this));
				});
			},
		});
	}

	function w_event_link_link_event($btn){
		var $modal = $('#w_event_link');
		var $tr = $btn.parents('tr.event');
		var $event = $('.event_'+$modal.data('id'));

		$.ajax({
			url: '/event/'+$modal.data('id')+'/link',
			data: {
				event_id : $tr.data('pk'),
			},
			success: function(){
				$modal.find('.m_event_selected').removeClass('m_event_selected');
				$tr.addClass('m_event_selected');
				$event.removeClass('danger');
				$event.find('.b_event_link').data('event_id', $tr.data('pk'));
				$modal.data('event_id', $tr.data('pk'));
			},
		});
	}

	function update_event($event, event){
		$event.find('.teams').html(event.team_home+' - '+event.team_away);
		if(event.teams_reversed)
			$event.find('.teams_reversed').show();
		else
			$event.find('.teams_reversed').hide();
		for(var field in FIELD_BET_STRINGS){
			$event.find('.'+field).html(event[field]);
		}
	}

});