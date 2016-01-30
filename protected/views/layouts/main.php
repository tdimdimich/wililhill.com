<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="icon" type="image/png" href="/img/wh-favicon.png" />
	
	
<?php
	Yii::app()->clientScript
			
		// jQuery
		->registerCssFile('/css/jquery-ui.min.css')
		->registerScriptFile('/js/jquery.min.js')
		->registerScriptFile('/js/jquery-ui.min.js')
		
		// jQuery Form Plugin http://malsup.com/jquery/form/
		->registerScriptFile('/js/jquery.form.min.js')
			
		// Bootstrap
		->registerCssFile('/css/bootstrap.min.css')
		->registerScriptFile('/js/bootstrap.min.js')
		
		// bootstrap-editable http://vitalets.github.io/bootstrap-editable/
		->registerCssFile('/css/bootstrap-editable.css')
		->registerScriptFile('/js/bootstrap-editable.min.js')
		
			
		// Date Format 1.2.3 http://blog.stevenlevithan.com/archives/date-time-format
		->registerScriptFile('/js/date.format.js')
			
		// Custom
		->registerCssFile('/css/bootstrap.ext.css')
		->registerCssFile('/css/styles.css')
		->registerScriptFile('/js/main.js');
?>
	
</head>

<body>
	
	<?php $this->renderPartial('/layouts/header'); ?>
	
	<div class="l_content margin-top-36">
		<div class="container">
			<?=$content?>
		</div>
	</div>
	
	<footer class="l_footer margin-top-24">
		<div class="container">
			<!--<p class="text-center">Developed by <a href="mailto:tdimdimich@ya.ru">tdimdimich@ya.ru</a></p>-->
		</div>
	</footer>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.yiiLog').addClass('table');
		});
	</script>
	
</body>
</html>

