<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>



<div class="p_team_index">
	
	<div class="i_search">
		<form class="" role="search">
			<div class="input-group">
				<input type="text" class="form-control i_search_q" name="q" value="<?=$q?>" placeholder="Search for...">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default">Search</button>
				</span>
			</div>
		</form>
	</div>
	
	<div class="margin-top-12">
		<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#w_team_add">
			<span class="glyphicon glyphicon-plus"></span> Добавить
		</button>
	</div>
	
	<div class="b_team_etopaz_table margin-top-24">
		<table class="table table-bordered table-striped ">
			<thead>
				<tr>
					<th>Оригинальное</th>
					<th>Замена</th>
					<th>Метод</th>
					<th>Управление</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($teams as $team): ?>
					<tr class="<?= $team->name ? 'success' : 'danger' ?>">
						<td><?=$team->orig?></td>
						<td><?=$team->name?></td>
						<td><?=$team->typeString?></td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#w_team_edit" 
										data-team_orig="<?=$team->orig?>" data-team_name="<?=$team->name?>">
									<span class="glyphicon glyphicon-pencil"></span>
								</button>
								<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#w_team_remove"
										data-team_orig="<?=$team->orig?>" data-team_name="<?=$team->name?>">
									<span class="glyphicon glyphicon-remove"></span>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>
	</div>
	
</div>

<!-- modal window w_team_add -->

<div id="w_team_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="w_team_add_i_label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="w_team_add_i_label">Добавление</h4>
			</div>
			<form class="w_team_add_f form-horizontal" action="/team/add" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-sm-4 ">Оригинальное</label>
						<div class="col-sm-8">
							<input class="form-control w_team_add_i_orig" type="text" name="orig"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 ">Замена</label>
						<div class="col-sm-8">
							<input class="form-control w_team_add_i_name" type="text" name="name"/>
						</div>
					</div>
					<div class="w_team_add_b_errors"></div>
					<div class="w_team_add_b_error_tmpl hidden" aria-hidden="true">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Ошибка!</strong> <span class="w_team_add_b_error_tmpl_i_msg"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Сохранить</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.w_team_add_f').submit(function(){
			event.preventDefault();
			$(this).ajaxSubmit({
				error: function(response){
					var $msg = $('.w_team_add_b_error_tmpl div:first').clone();
					$msg.find('.w_team_add_b_error_tmpl_i_msg').html(response.responseJSON.msg);
					$('.w_team_add_b_errors').append($msg);
				},
				success: function(){
					location.reload();
				},
			});
		});
	});
</script>


<!-- modal window w_team_edit -->

<div id="w_team_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="w_team_edit_i_label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="w_team_edit_i_label">Редактирование <span class="w_team_edit_i_label_span"></span></h4>
			</div>
			<form class="w_team_edit_f form-horizontal" action="/team/edit" method="post">
				<input class="w_team_edit_i_orig" type="hidden" name="orig"/>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-sm-4 ">Оригинальное</label>
						<div class="col-sm-8">
							<input class="form-control w_team_edit_i_orig" type="text" name="orig" disabled="true"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 ">Замена</label>
						<div class="col-sm-8">
							<input class="form-control w_team_edit_i_name" type="text" name="name"/>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Сохранить</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#w_team_edit').on('show.bs.modal', function(event) {
			var $this = $(this);
			var $btn = $(event.relatedTarget);
			
			$this.find('.w_team_edit_i_label_span').text($btn.data('team_orig')+' -> '+$btn.data('team_name'));
			$this.find('.w_team_edit_i_orig').val($btn.data('team_orig'));
			$this.find('.w_team_edit_i_name').val($btn.data('team_name'));
		});
		
		$('.w_team_edit_f').submit(function(event){
			event.preventDefault();
			$(this).ajaxSubmit({
				success: function(){
					location.reload();
				},
			});
		});
	});
</script>

<!-- modal window w_team_remove -->

<div id="w_team_remove" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="w_team_remove_i_label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="w_team_remove_i_label">Удаление</h4>
			</div>
			<div class="modal-body">
				<p>Вы действительно хотите удалить <strong><span class="w_team_remove_i_label_span"></span></strong>?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="w_team_remove_i_btn_delete btn btn-primary">Удалить</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#w_team_remove').on('show.bs.modal', function(event) {
			var $this = $(this);
			var $btn = $(event.relatedTarget);
			
			$this.find('.w_team_remove_i_label_span').text($btn.data('team_orig')+' -> '+$btn.data('team_name'));
			$('.w_team_remove_i_btn_delete').data('team_orig', $btn.data('team_orig'));
		});
		
		$('.w_team_remove_i_btn_delete').click(function(event){
			event.preventDefault();
			$this = $(this);
			$.ajax({
				url: '/team/delete',
				data: {orig: $this.data('team_orig')},
				success: function(){
					location.reload();
				},
			});
		});
	});
</script>

