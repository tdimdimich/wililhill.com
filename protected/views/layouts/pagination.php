<?php 
	// Параметры
	$url = isset($url) && $url ? $url.'&' : '?';
	$max = isset($max) ? $max : 9;
	$page = $list['page'];
	$count = $list['count'];
	$limit = $list['limit'];
	
	$max = max(7, $max); // создать вариант при меньше
	$max = $max - 2; // Не учитываем стрелки вперед и назад
	
	$page_count = (int)($count / $limit) + ($count % $limit > 0);
	if($page_count < 2) return;
?>


<ul class="pagination pull-right">
	
	<?php // Стрелка назад ?>
	<li><a <?=$page>1?'href="'.$url.'page='.($page-1).'"':''?>>&laquo;</a></li>
	
	<?php // Все страницы ?>
	<?php if($page_count < $max): ?>
		<?php for($i=1; $i <= $page_count; $i++): ?>
			<li class="<?=$i==$page?'active':''?>"><a href="<?=$url?>page=<?=$i?>"><?=$i?></a></li>
		<?php endfor; ?>
		
	<?php // В начале ?>
	<?php elseif($page < ($max / 2 + 1)): ?>
		<?php for($i = 1; $i <= ($max - 2); $i++): ?>
			<li class="<?=$i==$page?'active':''?>"><a href="<?=$url?>page=<?=$i?>"><?=$i?></a></li>
		<?php endfor; ?>
		<li><a>...</a></li>
		<li><a href="<?=$url?>page=<?=$page_count?>"><?=$page_count?></a></li>
		
	<?php // В конце ?>
	<?php elseif($page_count - $page < ($max / 2)): ?>
		<li><a href="<?=$url?>page=1">1</a></li>
		<li><a>...</a></li>
		<?php for($i = $page_count - ($max - 3); $i <= $page_count; $i++): ?>
			<li <?=$i==$page?'class="active"':''?>><a href="<?=$url?>page=<?=$i?>"><?=$i?></a></li>
		<?php endfor; ?>
	
	<?php // В середине ?>
	<?php else: ?>
		<li><a href="<?=$url?>page=1">1</a></li>
		<li><a>...</a></li>
		<?php for($i = $page - (int)(round($max / 2) - 3); $i <= $page + (int)($max / 2 - 2); $i++): ?>
			<li <?=$i==$page?'class="active"':''?>><a href="<?=$url?>page=<?=$i?>"><?=$i?></a></li>
		<?php endfor; ?>
		<li><a>...</a></li>
		<li><a href="<?=$url?>page=<?=$page_count?>"><?=$page_count?></a></li>
	<?php endif; ?>
		
	<?php // Стрелка вперед ?>
	<li><a <?=$page<$page_count?'href="'.$url.'page='.($page+1).'"':''?>>&raquo;</a></li>
</ul>

