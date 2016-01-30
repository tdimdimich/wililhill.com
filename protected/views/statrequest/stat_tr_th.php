
<tr class="<?=$stat->getCssClass()?> success">
	<th><?= $stat->action ?></th>
	<th><?= $stat->count ?></th>
	<th><?= format_microtime($stat->time_min) ?></th>
	<th><?= format_microtime($stat->time_max) ?></th>
	<!--<th><?= format_microtime($stat->time_last) ?></th>-->
	<th><?= format_microtime($stat->count ? (int)($stat->time_total/$stat->count) : 0) ?></th>
</tr>
