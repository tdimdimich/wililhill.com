<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<a href="/" class="navbar-brand">WililHill</a>
		</div>
		<div class="navbar-header navbar-loading-indicator">
			<img class="loading-indicator" src="/img/ajax-loader.gif" style="display:none"/>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse">
			<ul class="nav navbar-nav">
				<?php if(User::current()): ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							Вилки <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/fork/all">Все</a></li>
							<li><a href="/fork/compact">Лучшие</a></li>
							<li><a href="/fork/live">Live</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							События
							<label class="label label-danger label-count"><?=Event::getSingleCombineCounts()?></label>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/event/combine"><span>Объединенные</span></a></li>
							<li><a href="/event/notcombine"><span>Неполные</span></a></li>
							<li><a href="/event/etz">Etopaz</a></li>
							<li><a href="/event/pns">Pinnacle Sports</a></li>
							<li><a href="/event/wlh">William Hill</a></li>
						</ul>
					</li>
					<?php if(User::current()->is_admin): ?>
						<li><a href="/team">Команды</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Настройки<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/admin/settings">Параметры</a></li>
								<li><a href="/command">Скрипты</a></li>
								<li><a href="/statrequest">Статистика</a></li>
								<li><a href="/stattime">Время выполнения</a></li>
							</ul>
						</li>
					<?php endif; ?>
				<?php endif; ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if(Yii::app()->settings->get('events_updated')): ?>
					<li>
						<span class="header_updated">
							Обновленно: <span class="events_updated js_locale_time"><?=Yii::app()->settings->get('events_updated')?></span>
						</span>
					</li>
				<?php endif; ?>
				<?php if(User::current()): ?>
					<li><a href=""><?=User::current()->username?></a></li>
					<li><a href="/logout">Logout</a></li>
				<?php else: ?>
					<li><a href="/login">Login</a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</div>
</header>