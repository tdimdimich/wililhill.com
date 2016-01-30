<?php 
	

?>



<div class="p_user_login">
	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label class="col-sm-4 control-label">Имя пользователя</label>
			<div class="col-sm-8">
				<input class="form-control" type="text"  placeholder="Имя пользователя" name="user[username]" value="<?=$username?>"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Пароль</label>
			<div class="col-sm-8">
				<input class="form-control" type="password"  placeholder="Пароль" name="user[password]"/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<div class="checkbox">
					<label><input type="checkbox" name="rememberme"/> Запомнить меня</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-default">Логин</button>
			</div>
		</div>
	</form>
</div>