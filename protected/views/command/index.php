<?php

?>



<div class="p_command_index">
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Управление событиями</h3>
		</div>
		<div class="panel-body p_command_index_b_commands">
			<a class="btn btn-primary" data-ctrl="event" data-action="link">LinkEvents</a>
			<a class="btn btn-warning" data-ctrl="event" data-action="unlink">UnlinkEvents</a>
			<a class="btn btn-primary" data-ctrl="event" data-action="updateforks">UpdateForks</a>
			<a class="btn btn-danger" data-ctrl="event" data-action="clear">Clear</a>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Грабберы</h3>
		</div>
		<div class="panel-body p_command_index_b_commands">
			<a class="btn btn-primary" data-ctrl="grabber" data-action="grabetz">Etopaz</a>
			<a class="btn btn-success" data-ctrl="grabber" data-action="grabetzlive">Etopaz Live</a>
			<a class="btn btn-primary" data-ctrl="grabber" data-action="grabpns">Pinnacle Sports</a>
			<a class="btn btn-primary" data-ctrl="grabber" data-action="grabwlh">William Hill</a>
		</div>
	</div>
	
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.p_command_index_b_commands a').click(function(){
			var $this = $(this);
			if($this.hasClass('disabled')) return;
			$this.addClass('disabled');
			$.ajax({
				url: '/command/run',
				data: {
					ctrl: $this.data('ctrl'),
					action: $this.data('action'),
				},
				complete : function(){
					$this.removeClass('disabled');
				},
			});
		});
	});
</script>
