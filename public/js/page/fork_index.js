$(document).ready(function(){

	var updateInterval = setInterval(updateForks, 10000);
	var audio = new Audio('/sound/notification.mp3');
	var kfork_list;
	var KFORK_MARK_LIFE = 6;
	var kfork_changed = false;
	var deltaUpClass = 'glyphicon glyphicon-arrow-up';
	var deltaDownClass = 'glyphicon glyphicon-arrow-down';

	updateForks();

	function updateForks(){
		$.ajax({
			url: '/fork/getlist',
			data: UPDATE_FORK_PARAM,
			dataType: 'json',
			success: function(response){
				update_header(response);
				kfork_apply(response.list);
				renderTable(response.list);
				markChanges(response.list);
				if(kfork_changed) audio.play();
			},
		});
	}

	function renderTable(forks){
		var $tbody = $('.p_fork_index table tbody');
		$tbody.empty();
		for(var i in forks){
			var fork = forks[i];
			var cevent = fork.event;
			var kfork = kfork_list[fork.id];

			var $tr = $($('.template_fork').html());
			$tr.addClass('fork_'+fork.id);
			$tr.data('cevent_id', cevent.id);
			$tr.addClass('owner_event_'+cevent.id);
			$tr.find('.win .value').text(kfork.win.value).addClass(kfork.win.value>=0?'m_positive':'m_negative');
			$tr.find('.rate .value').text(kfork.rate.value).addClass(kfork.rate.value>=1?'m_positive':'m_negative');
			$tr.find('.date').text(cevent.date);
			$tr.find('.type').text(FORK_STRINGS[fork.type]);
			$tbody.append($tr);
			init_btn_hide($tr);

			for(var field in fork.events){
				var event = fork.events[field];
				var $tr = $($('.template_fork_event').html());
				$tr.addClass('fork_'+fork.id+'_'+field);
				$tr.addClass(SRCTYPE_CLASS[event.src_type]);
				$tr.addClass('owner_event_'+cevent.id);
				$tr.find('.source').text(SRCTYPE_STRINGS[event.src_type]);
				$tr.find('.teams').text(event.team_home+' - '+event.team_away);
				if(parseInt(event.teams_reversed)) $tr.find('.teams_reversed').show();
				if(event.etz_mbs) $tr.find('.etz_mbs').addClass('etz_mbs'+event.etz_mbs);
				else $tr.find('.etz_mbs').hide();
				if(event.islive == 0) $tr.find('.m_event_islive').hide();
				$tr.find('.event_id').text(event.int_code);
				$tr.find('.field').text(FIELD_BET_STRINGS[field]);
				$tr.find('.factor .value').text(kfork[field].value);
				$tbody.append($tr);
			}
		}
		localeDates();
	}

	function markChanges(forks){
		for(var i in forks){
			var fork = forks[i];
			var kfork = kfork_list[fork.id];
			if(kfork.win.isnew){
				$('.fork_'+fork.id+' .win .delta').text('(New)').addClass('m_positive');
			}
			if(kfork.win.delta != 0){
				markChangedDelta('.fork_'+fork.id+' .win .delta', kfork.win.delta);
			}
			if(kfork.rate.delta != 0){
				markChangedDelta('.fork_'+fork.id+' .rate .delta', kfork.rate.delta);
			}
			for(var field in fork.events){
				if(kfork[field].delta != 0){
					markChangedDelta('.fork_'+fork.id+'_'+field+' .factor .delta', kfork[field].delta);
				}
			}
		}
	}

	function markChangedDelta(element, delta){
		if(delta > 0){
			$(element).addClass('m_positive').html('<i class="'+deltaUpClass+'"/> +'+delta);
		}else{
			$(element).addClass('m_negative').html('<i class="'+deltaDownClass+'"/> '+delta);
		}
	}

	function kfork_apply(forks){
		if(kfork_list){
			kfork_changed = false;
			for(var i in forks){
				var fork = forks[i];
				var kfork = kfork_list[fork.id];

				if(kfork){
					kfork_step(kfork);
					kfork_changes(kfork, fork);
				}else{
					kfork = kfork_create(fork);
					kfork_asnew(kfork);
					kfork_list[fork.id] = kfork;
				}
			}
		}else{
			kfork_list = kfork_createList(forks);
		}
	}

	function kfork_createList(forks){
		var list = [];
		for(var i in forks){
			var fork = forks[i];
			list[fork.id] = kfork_create(fork);
		}
		return list;
	}

	function kfork_create(fork){
		var kfork = {
			win: {value: fork.win, delta: 0},
			rate: {value: fork.rate, delta: 0},
		};
		for(var field in fork.events){
			kfork[field] = {value: fork.events[field][field], delta: 0};
		}
		return kfork;
	}


	function kfork_asnew(kfork){
		kfork.win.isnew = true;
		kfork.win.life = KFORK_MARK_LIFE;
	}

	function kfork_step(kfork){
		for(var i in kfork){
			var kfork_item = kfork[i];
			if(kfork_item.isnew || kfork_item.delta!=0){
				kfork_item.life--;
				if(kfork_item.life < 0){
					kfork_item.delta = 0;
					kfork_item.isnew = false;
					kfork_item.life = 0;
				}
			}
		}
	}

	function kfork_changes(kfork, fork){
		// если вилка еще не обнавилась
		if(kfork.win.value == fork.win && kfork.win.value == fork.win) return;
		kfork_changes0(kfork.win, fork.win);
		kfork_changes0(kfork.rate, fork.rate);
		for(var field in fork.events){
			kfork_changes0(kfork[field], fork.events[field][field]);
		}
	}
	function kfork_changes0(kfork_item, val){
		if(val != kfork_item.value){
			kfork_item.delta = Math.round((val - kfork_item.value) * 10000) / 10000;
			kfork_item.value = val;
			kfork_item.life = KFORK_MARK_LIFE;
			kfork_item.isnew = false;
			kfork_changed = true;
		}
	}

	function init_btn_hide($tr){
		$tr.find('.b_event_hide').click(function(){
			var $this = $(this);
			var event_id = $tr.data('cevent_id');
			$.ajax({
				url: '/event/'+event_id+'/hide',
				success: function(){
					$('.owner_event_'+event_id).hide();
				}
			});
		});
	}

});