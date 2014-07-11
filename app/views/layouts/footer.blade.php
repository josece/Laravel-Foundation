<footer class="site__footer hide-for-small">
	<div class="row">
		<div class="large-6 columns text--small small-5">
			Copyright {{ date('Y') }} &copy; {{link_to('http://calleja.mx', 'CALLEJA.MX', $attributes = array('target' => '_blank', 'title' => 'CALLEJA.MX / Software Artisans'), $secure = null) }}
			<br />
		</div>
		<div class="large-6 columns  text-right small-7">
			<ul class="inline-list text--small right list--nomargin">
				<li>{{Lang::get('global.termsofuse')}}</li> 
				<li>{{Lang::get('global.privacynotice')}}</li>
			</ul>
		</div>
	</div>
</footer>
