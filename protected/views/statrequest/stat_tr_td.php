
<tr class="<?=$stat->getCssClass()?>">
	<td><?= $stat->action ?></td>
	<td><?= $stat->count ?></td>
	<td><?= format_microtime($stat->time_min) ?></td>
	<td><?= format_microtime($stat->time_max) ?></td>
	<!--<td><?= format_microtime($stat->time_last) ?></td>-->
	<td><?= format_microtime($stat->count ? (int)($stat->time_total/$stat->count) : 0) ?></td>
</tr>
