@extends('master')
@section('content')
<div class="container">
    <div id="content">
        <form action="{{ route('post-Mail') }}" method="POST" role="form">
		@csrf
		<legend>Form title</legend>
	
		<div class="form-group">
			<label for="">Email</label>
			<input type="text" class="form-control" id="" name="email" placeholder="Input field">
		</div>

		<div class="form-group">
			<label for="">Subject</label>
			<input type="text" class="form-control" id="" name="subject" placeholder="Input field">
		</div>

		<div class="form-group">
			<label for="">Message</label>
			<input type="text" class="form-control" id="" name="message" placeholder="Input field">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
       
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
