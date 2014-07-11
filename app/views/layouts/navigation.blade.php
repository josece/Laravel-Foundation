<header class="nav-down header">
	<nav class="top-bar topnav" data-topbar>

		<section class="show-for-small ">
			<div class="toggle-topbar  menu-icon left">
				<a class="left-off-canvas-toggle" href="#">{{Lang::get('global.menu')}}<span></span></a>
			</div>
		</section>
		<section class="topnav__logo small-centered large-uncentered small-4 medium-3 large-4 columns">
			<a href="{{url('user/home')}}" ><h1 class="left">{{Lang::get('global.appname')}}</h1></a>
		</section>
		<section class="top-bar-section">
			@if(!Auth::check())
			<ul class="right hide-for-small">
				<li class="{{ (strpos(URL::current(), URL::to('user/register'))!== false) ? 'active' : '' }}">{{ HTML::link('user/register', Lang::get('form.signup')) }}</li>   
				<li class="{{ (strpos(URL::current(), URL::to('user/login'))!== false) ? 'active' : '' }}">{{ HTML::link('user/login', Lang::get('form.login')) }}</li>   
			</ul>
			@else
			<ul class="right hide-for-small">	
				<li class="{{(strpos(URL::current(), URL::to('stores'))!== false) ? 'active' : ''; }}">
					{{ HTML::link('stores', Lang::get('stores.store--title'))}}</li>   
					@if($user->role_id > 2)
					<li class="{{ (strpos(URL::current(), URL::to('admin/users'))!== false) ? 'active' : '' }}">
						{{ HTML::link('admin/users', Lang::get('form.users'))}}</li>   
						@endif
						<li class="has-dropdown">
							<a href="#">
								<?php $photourl = !empty($user->photo) ? $user->photo: Config::get('configuration.picture--default');?>
								{{HTML::image($photourl, Lang::get('global.profilepic'), array('class' => 'photo--thumbnail left hide-for-small'))}}
								{{$user->firstname}}
							</a>
							<ul class="dropdown">
								@if($user->role_id > 2)
								<li>{{ HTML::link('admin', Lang::get('global.admin')) }}</li> 
								@endif
								<li>{{ HTML::link('user/edit', Lang::get('global.editinfo')) }}</li>
								<li>{{ HTML::link('user/logout', Lang::get('global.logout')) }}</li>
							</ul>
						</li>
					</ul>

					@endif			
				</section>
			</nav>
		</header>
		<aside class="left-off-canvas-menu">
			<ul class="off-canvas-list">
				<li class="show-for-small">
					<label>{{$appname}}</label>
				</li>
				@if(Auth::check())
				<li>{{HTML::image($photourl, Lang::get('global.profilepic'), array('class' => 'photo--thumbnail left '))}}
					<a href="#">{{$user->firstname}}</a> </li>
					@if($user->role_id > 2)<li>{{ HTML::link('admin', Lang::get('global.admin')) }}</li>
					<li></li>
					@endif
					<li><label>{{Lang::get('global.navigation')}}</label></li>
					<li>{{ HTML::link('user/edit', Lang::get('global.editinfo')) }}</li>
					<li>{{ HTML::link('user/logout', Lang::get('global.logout')) }}</li>
					<hr />
					@else
					<li class="{{Request::is('user/register') ? 'active' : ''}}">{{ HTML::link('user/register', Lang::get('form.signup')) }}</li>   
					<li class="{{Request::is('user/login') ? 'active' : ''}}">{{ HTML::link('user/login', Lang::get('form.login')) }}</li>   
					@endif
					<li>{{ HTML::link('terms', Lang::get('global.termsofuse')) }}</li>
					<li>{{ HTML::link('privacy-notice', Lang::get('global.privacynotice')) }}</li>
					<li></li>
					<li><label>{{Lang::get('global.builtby')}}</label>{{ HTML::link('http://calleja.mx', 'CALLEJA.MX') }}</li>
				</ul>
			</aside>