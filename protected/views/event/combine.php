<?php
	/* @var $this Controller */

	Yii::app()->clientScript->registerScriptFile('/js/page/event_combine.js', ClientScript::POS_END);
	
	$title = $this->action->id == 'combine' ? 'Объединенные события' : 'Неполные события';
	
?>



<div class="p_event_index">
	
	<h3><?=$title?> (найдено <?=$list['count']?>)</h3>
	
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
			<?php foreach($list['items'] as $cevent): /* @var $event Event */?>
				<tr class="spacer"></tr>
				<tr class="pk_cevent_<?=$cevent->id?> <?=$cevent->visible?'':'b_event_hidden'?>" data-pk="<?=$cevent->id?>">
					<th>Дата</th>
					<th>Источник</th>
					<th>Команды</th>
					<?php foreach(Fork::$TYPES_ENABLED as $fork_type): ?>
						<th><?=Fork::$TYPE_STRINGS[$fork_type]?></th>
					<?php endforeach; ?>
				</tr>
				<tr class="pk_cevent_<?=$cevent->id?> <?=$cevent->visible?'':'b_event_hidden'?>">
					<th class="js_locale_dates"><?=$cevent->date?></th>
					<th>
						<?php if(User::current() && User::current()->is_admin): ?>
							<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#w_event_setting"
								data-pk="<?=$cevent->id?>"
								data-label="<?=$cevent->team_home?> - <?=$cevent->team_away?>" 
								data-event_date="<?=$cevent->date?>"
								>
								<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
							</a>
						<?php endif; ?>
					</th>
					<th><?=$cevent->team_home?><br><?=$cevent->team_away?></th>
					<?php foreach(Fork::$TYPES_ENABLED as $fork_type): ?>
						<th>
							<?php $fork = $cevent->getForkByType($fork_type); ?>
							<span class="i_fork_rate"><?=$fork->rate?></span><br/>
							<span class="i_fork_rate"><?=$fork->win?></span>
						</th>
					<?php endforeach; ?>
				</tr>
				<?php foreach($cevent->events as $event): ?>
					<tr class="pk_cevent_<?=$cevent->id?> <?=$event->getCssClass()?> <?=$cevent->visible?'':'b_event_hidden'?>">
						<td class="text-right"><?=$event->enabled?'':'Не активен'?></td>
						<td><?=Event::$SRCTYPE_STRINGS[$event->src_type]?></td>
						<td>
							<?=$event->team_home?><br><?=$event->team_away?><br>
							<?php if($event->teams_reversed): ?>
								<span class="glyphicon small glyphicon-refresh" aria-hidden="true"></span>
							<?php endif; ?>
							<?php if($event->etz_mbs): ?>
								<span class="etz_mbs etz_mbs<?=$event->etz_mbs?>"></span>
							<?php endif; ?>
							<?php if($event->islive): ?>
								<span class="m_event_islive label label-danger">
									<span class="glyphicon glyphicon-time"></span> Live
								</span>
							<?php endif; ?>
							<br/>
							<span class="js_locale_dates small"><?=$event->date?></span>
						</td>
						<?php foreach(Fork::$TYPES_ENABLED as $fork_type): ?>
							<td>
								<?php $fork = $cevent->getForkByType($fork_type); ?>
								<?php foreach(Fork::$FORK_FIELDS[$fork_type] as $fork_field): ?>
									<?php if($fork->win && (
										($fork->f1_event == $event && Fork::$FORK_FIELDS[$fork_type][0] == $fork_field) ||
										($fork->f2_event == $event && Fork::$FORK_FIELDS[$fork_type][1] == $fork_field) ||
										($fork->f3_event && $fork->f3_event == $event && Fork::$FORK_FIELDS[$fork_type][2] == $fork_field)
									)): ?>
										<b><?=$event->$fork_field?></b><br/>
									<?php else: ?>
										<?=$event->$fork_field?><br/>
									<?php endif; ?>
								<?php endforeach; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php $this->renderPartial('/layouts/pagination', ['list' => $list, 'url' => $q ? "?q=$q" : '']); ?>
	
</div>

<!-- modal window w_event_setting -->
<div id="w_event_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="w_event_setting_i_label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="w_event_setting_i_label">
					Событие <span class="w_event_setting_i_label_date"></span> <span class="w_event_setting_i_label_span"></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<input class="w_event_setting_b_search_q form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="w_event_setting_b_search btn btn-default">Search</button>
					</span>
				</div>
				<table class="table table-bordered margin-top-24">
					<thead>
						<tr>
							<th>Дата</th>
							<th>Источник</th>
							<th>Команды</th>
							<th>Статус</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="w_event_setting_event_list">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger w_event_setting_i_hide">Скрыть</button>
				<button class="btn btn-primary w_event_setting_i_show">Показать</button>
				<button class="btn btn-default w_event_setting_i_close" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="hidden">
	<template class="template_event_tr">
		<tr class="event">
			<td class="date"></td>
			<td class="src"></td>
			<td>
				<span class="teams"></span>
				<span class="m_event_islive label label-danger">
					<span class="glyphicon glyphicon-time"></span> Live
				</span>
			</td>
			<td class="status"></td>
			<td>
				<button class="btn btn-success w_event_setting_i_event_unselect"><span class="glyphicon glyphicon-ok"></span> Выбрано</button>
				<button class="btn btn-default w_event_setting_i_event_select">Выбрать</button>
			</td>
		</tr>
	</template>
</div>

<script type="text/javascript">
	
	var SRCTYPE_STRINGS = {
		<?php foreach(Event::$SRCTYPE_STRINGS as $type => $string): ?>
			'<?=$type?>' : '<?=$string?>',
		<?php endforeach; ?>
	};

	var SRCTYPE_CLASS = {
		<?php foreach(Event::$CSS_CLASSES as $type => $string): ?>
			'<?=$type?>' : '<?=$string?>',
		<?php endforeach; ?>
	};
	
</script>
