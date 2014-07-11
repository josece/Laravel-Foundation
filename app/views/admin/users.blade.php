<div class="row">
	<div class="large-12 columns">
		<h2>{{Lang::get('form.users')}}
		<table>
			<thead>
				<tr>
					<th>{{Lang::get('form.id')}}</th>
					<th>{{Lang::get('form.firstname')}}</th>
					<th>{{Lang::get('form.lastname')}}</th>
					<th>{{Lang::get('form.email')}}</th>
					<th>{{Lang::get('form.role')}}</th>
					<th colspan="2">{{Lang::get('form.actions')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)

				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->firstname}}</td>
					<td>{{$user->lastname}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->role_id}}</td>
					<td>{{HTML::Link('admin/usersedit/' . $user->id, Lang::get('form.edit'), array('class'=>'button tiny message'))}}</td>
					<td>{{-- HTML::Link('admin/users-disable/' . $user->id, Lang::get('form.disable'), array('class'=>'button tiny alert')) --}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>