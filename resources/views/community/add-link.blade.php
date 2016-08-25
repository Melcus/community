@if (Auth::check())
	<div class="col-md-4">
	<h2>Contribute</h2>



	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="/community">
				{{ csrf_field() }}

				 <div class="form-group  {{ $errors->has('category') ? ' has-error' : '' }}">
				    <label for="category">Category: </label>
				   
				   <select name="category" class="form-control">
				   	<option selected disabled>Pick a category</option>
				   	@foreach ($categories as $category)
				   			<option value="{{ $category -> id}}" {{old('category') == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
				   	@endforeach
				  
				   </select>

				   @if ($errors->has('category'))
				       <span class="help-block">
				           <strong>{{ $errors->first('category') }}</strong>
				       </span>
				   @endif
				 </div>

				<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
					<label for="title">Title: </label>
					<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" placeholder="What is the title of your article?" required>

					@if ($errors->has('title'))
					<span class="help-block">
						<strong>{{ $errors->first('title') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
					<label for="link">Link: </label>
					<input type="text" name="link" id="link" class="form-control" value="{{old('link')}}" placeholder="What is the URL?" required>
					@if ($errors->has('link'))
					<span class="help-block">
						<strong>{{ $errors->first('link') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group">
					<button class="btn btn-primary">Contribute Link</button>
				</div>
			</form>


		</div>
	</div>

</div>
@else
<div>Please sign in to post.</div>
@endif
