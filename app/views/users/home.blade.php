<div class="row">
	<div class="large-12 small-12 columns">
				<h1>Dashboard</h1>

    Hello, {{$user->firstname}} 
	
    <br>
    Your email is {{$user->email}}
    <br>
    @if($user->hasRole('admin'))
    	si!
    @else
    	no!
    @endif

    Tu rol actual es {{$user->getRole()}}

    @foreach ($user->getRoles() as $key=>$rol)
    {{$key}} ->{{$rol}}
    @endforeach
   </div>
</div>