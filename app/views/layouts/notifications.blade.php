<div class="row alert__row">
    <div class="large-12 small-12 columns alert__container">
        @if(Session::has('message'))
        <div data-alert class="alert-box large-6 small-centered columns">
            {{ Session::get('message') }}
            <a href="#" class="close">&times;</a>
        </div>
        @endif
        @if(Session::has('success'))
        <div data-alert class="alert-box success large-6 small-centered columns">
            {{ Session::get('success') }}
            <a href="#" class="close">&times;</a>
        </div>
        @endif
        @if(Session::has('alert'))
        <div data-alert class="alert-box alert large-6 small-centered columns" >
            {{ Session::get('alert') }}
            <a href="#" class="close">&times;</a>
        </div>
        @endif
        <?php /*Errores de validacion --}}
            @if($errors->has())
                @foreach ($errors->all() as $error)
                 <div data-alert class="alert-box alert large-6 small-centered columns" >
                    {{ $error }}
                    <a href="#" class="close">&times;</a>
                 </div>
                @endforeach
            @endif
*/?>
        @if(Session::has('warning'))
        <div data-alert class="alert-box warning large-6 small-centered columns" >
            {{ Session::get('warning') }}
            <a href="#" class="close">&times;</a>
        </div>
        @endif  
    </div>
</div>