<div id="alert-container">
	@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li><i class="mdi mdi-block-helper mr-1"></i>{!! $error !!}</li>
	        @endforeach
	    </ul>
	</div>
	@endif

	@if(session('danger'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="mdi mdi-block-helper mr-1"></i>
	    {!! session('danger')!!}
	</div>
	@endif

	@if(session('warning'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="mdi mdi-alert-outline mr-1"></i>
	    {!! session('warning')!!}
	</div>
	@endif

	@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="mdi mdi-check mr-1"></i>
		{!! session('success') !!}
	</div>
	@endif
    
</div>