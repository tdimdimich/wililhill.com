<?php

?>



<div class="p_admin_settings">
	
	<form class="form-horizontal" method="post">
		<?php foreach(Settings::$LABELS as $name => $label): ?>
			<div class="form-group">
				<label class="col-sm-4 control-label"><?=$label?></label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="<?=$name?>" value="<?=Yii::app()->settings->get($name)?>"/>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-default">Сохранить</button>
			</div>
		</div>
	</form>
	
</div>