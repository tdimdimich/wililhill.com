<?php
	/* @var $this StatController */

	/* @var $stat_total StatTime */
	/* @var $stat_list array */
	
?>


<div class="p_stat_index">
	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Action</th>
				<th>Count</th>
				<th>Time min</th>
				<th>Time max</th>
				<!--<th>Time last</th>-->
				<th>Time avg</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($stat_list as $stat): ?>
				<?php $this->renderPartial('stat_tr_td', ['stat' => $stat]); ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<div class="panel panel-default">
		<div class="panel-body p_command_index_b_commands">
			<button class="btn btn-danger p_stat_index_b_clear pull-right">Очистить</button>
		</div>
	</div>
	
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('.p_stat_index_b_clear').click(function(){
			$.ajax({
				url: '/stattime/clear',
				success: function(){
					location.reload();
				}
			});
		});
	});
</script>
