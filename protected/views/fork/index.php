<?php
	/* @var $this ForkController */
	/* @var $params array */
	$params = isset($params) ? $params : [];
	
	Yii::app()->clientScript->registerScriptFile('/js/page/fork_index.js', ClientScript::POS_END);
	
?>



<div class="p_fork_index">
	
	<table class="table table-bordered">
		<tbody>
		</tbody>
	</table>
	
	<div class="hidden">
		<template class="template_fork">
			<tr class="spacer"></tr>
			<tr>
				<th class="win">
					<span class="value"></span>
					<span class="delta small"></span>
				</th>
				<th class="rate">
					<span class="value"></span>
					<span class="delta small"></span>
				</th>
				<th class="">
					<span class="date js_locale_dates"></span>
					<?php if(User::current()->is_admin): ?>
						<a class="b_event_hide">Скрыть событие</a>
					<?php endif; ?>
				</th>
				<th>Код</th>
				<th class="type"></th>
				<th>Коэффициент</th>
			</tr>
		</template>
		<template class="template_fork_event">
			<tr>
				<td></td>
				<td class="source"></td>
				<td>
					<span class="teams"></span>
					<span class="teams_reversed glyphicon small glyphicon-refresh" aria-hidden="true" style="display: none;"></span>
					<span class="etz_mbs"></span>
					<span class="m_event_islive label label-danger">
						<span class="glyphicon glyphicon-time"></span> Live
					</span>
				</td>
				<td class="event_id"></td>
				<td class="field"></td>
				<td class="factor">
					<span class="value"></span>
					<span class="delta small"></span>
				</td>
			</tr>
		</template>
	</div>
	
</div>

<script type="text/javascript">
		
	var FORK_STRINGS = {
		<?php foreach(Fork::$TYPE_STRINGS as $type => $string): ?>
			'<?=$type?>' : '<?=$string?>',
		<?php endforeach;?>
	};

	var FIELD_BET_STRINGS = {
		<?php foreach(Event::$FIELD_BET_STRINGS as $field => $string): ?>
			'<?=$field?>' : '<?=$string?>',
		<?php endforeach; ?>
	};

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

	var UPDATE_FORK_PARAM = <?=CJSON::encode($params)?>;
		
</script>
