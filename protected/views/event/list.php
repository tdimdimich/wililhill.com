<?php
	/* @var $this Controller */
	/* @var $events array */

	Yii::app()->clientScript->registerScriptFile('/js/page/event_list.js', ClientScript::POS_END);

	$LABEL_FIELDS = [
		'Матч' => [
			Event::FIELD_BET_M_1, Event::FIELD_BET_M_X, Event::FIELD_BET_M_2,
			Event::FIELD_BET_M_1X, Event::FIELD_BET_M_12, Event::FIELD_BET_M_X2,
		],
		'Матч Тоталы' => [
			Event::FIELD_BET_M_TO15, Event::FIELD_BET_M_TU15,
			Event::FIELD_BET_M_TO25, Event::FIELD_BET_M_TU25,
			Event::FIELD_BET_M_TO35, Event::FIELD_BET_M_TU35,
		],
		'Home Тоталы' => [
			Event::FIELD_BET_M_1TO05, Event::FIELD_BET_M_1TU05,
			Event::FIELD_BET_M_1TO15, Event::FIELD_BET_M_1TU15,
			Event::FIELD_BET_M_1TO25, Event::FIELD_BET_M_1TU25,
		],
		'Away Тоталы' => [
			Event::FIELD_BET_M_2TO05, Event::FIELD_BET_M_2TU05,
			Event::FIELD_BET_M_2TO15, Event::FIELD_BET_M_2TU15,
			Event::FIELD_BET_M_2TO25, Event::FIELD_BET_M_2TU25,
		],
		'Матч Гол есть/нет' => [
			Event::FIELD_BET_M_GH, Event::FIELD_BET_M_GN,
		],
		'Тайм 1' => [
			Event::FIELD_BET_P1_1, Event::FIELD_BET_P1_X, Event::FIELD_BET_P1_2
		],
		'Тайм 1 Тоталы' => [
			Event::FIELD_BET_P1_TO05, Event::FIELD_BET_P1_TU05,
			Event::FIELD_BET_P1_TO15, Event::FIELD_BET_P1_TU15,
			Event::FIELD_BET_P1_TO25, Event::FIELD_BET_P1_TU25,
			Event::FIELD_BET_P1_TO35, Event::FIELD_BET_P1_TU35,
		],
		'Тайм 1 Гол есть/нет' => [
			Event::FIELD_BET_P1_GH, Event::FIELD_BET_P1_GN,
		],
		'Тайм 2' => [
			Event::FIELD_BET_P2_1, Event::FIELD_BET_P2_X, Event::FIELD_BET_P2_2
		],
		'Тайм 2 Тоталы' => [
			Event::FIELD_BET_P2_TO05, Event::FIELD_BET_P2_TU05,
			Event::FIELD_BET_P2_TO15, Event::FIELD_BET_P2_TU15,
			Event::FIELD_BET_P2_TO25, Event::FIELD_BET_P2_TU25,
			Event::FIELD_BET_P2_TO35, Event::FIELD_BET_P2_TU35,
		],
		'Тайм 2 Гол есть/нет' => [
			Event::FIELD_BET_P2_GH, Event::FIELD_BET_P2_GN,
		],
	];
	
?>

<div class="p_event_list">
	
	<h3>События с <?=Event::$SRCTYPE_FULLSTRINGS[$src_type]?> (найдено <?=$list['count']?>)</h3>
	
	<div class="i_search margin-bottom-24">
		<form class="i_search_form" role="search">
			<div class="input-group">
				<input type="text" class="form-control i_search_q" name="q" value="<?=$q?>" placeholder="Search for...">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default">Search</button>
				</span>
			</div>
		</form>
	</div>
	
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th>Дата</th>
				<th>Статус</th>
				<th>Команды</th>
				<?php foreach($LABEL_FIELDS as $LABEL => $FIELDS): ?>
					<th>
						<?=$LABEL?><br/>
					</th>
				<?php endforeach; ?>
			</tr>
			<?php foreach($list['items'] as $event): ?>
				<tr class="event event_<?=$event->id?> <?=$event->getCssClass()?> <?=$event->event_id?'':'danger'?>">
					<td class="js_locale_dates date"><?=$event->date?></td>
					<td class="text-right"><?=$event->enabled?'':'Не активен'?></td>
					<td>
						<span class="teams"><?=$event->team_home?><br><?=$event->team_away?></span><br>
						<span class="teams_reversed glyphicon small glyphicon-refresh <?=$event->teams_reversed?'':'jqhide'?>" aria-hidden="true"></span>
						<?php if(User::current()->is_admin): ?>
							<a class="b_event_link" data-toggle="modal" data-target="#w_event_link"
								data-id="<?=$event->id?>" data-event_id="<?=$event->event_id?>">Событие</a>
						<?php endif; ?>
						<?php if($event->etz_mbs): ?>
							<span class="etz_mbs etz_mbs<?=$event->etz_mbs?>"></span>
						<?php endif; ?>
						<?php if($event->islive): ?>
							<span class="m_event_islive label label-danger">
								<span class="glyphicon glyphicon-time"></span> Live
							</span>
						<?php endif; ?>
					</td>
					<?php foreach($LABEL_FIELDS as $LABEL => $FIELDS): ?>
						<td>
							<?php foreach($FIELDS as $field): ?>
								<span title="<?=Event::$FIELD_BET_STRINGS[$field]?>"><?=$event->$field?></span><br/>
							<?php endforeach; ?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php $this->renderPartial('/layouts/pagination', ['list' => $list, 'url' => $q ? "?q=$q" : '']); ?>
	
</div>

<!-- modal window w_event_link -->
<div id="w_event_link" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="w_event_link_i_label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="w_event_link_i_label">Событие <span class="w_event_link_i_label_span"></span></h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<input class="w_event_link_b_search_q form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="w_event_link_b_search btn btn-default">Search</button>
					</span>
				</div>
				<table class="table table-bordered margin-top-24">
					<thead>
						<tr>
							<th>Команды</th>
							<th>Дата</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="w_event_link_event_list">
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button class="btn btn-warning w_event_link_i_reverse">Перевернуть команды</button>
				<button class="btn btn-danger w_event_link_i_remove">Удалить привязку</button>
				<button class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="hidden">
	<template class="template_event_tr">
		<tr class="event">
			<td>
				<span class="teams"></span>
			</td>
			<td>
				<span class="date js_locale_dates"></span>
			</td>
			<td>
				<button class="link_event">Выбрать</button>
				<span class="event_linked">Выбрано</span>
			</td>
		</tr>
	</template>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		
		var FIELD_BET_STRINGS = {
			<?php foreach(Event::$FIELD_BET_STRINGS as $field => $string): ?>
				'<?=$field?>' : '<?=$string?>',
			<?php endforeach; ?>
		};
		
	});
</script>
