<ul class="list-group"> 

	@if (count($links))
	@foreach ($links as $link)
	<li class="list-group-item CommunityLink">

		<form method="POST" action="/votes/{{ $link->id }}">
			{{ csrf_field() }}
			<button class="btn {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-default' }}">
				{{ $link->votes->count() }}
			</button>

		</form>
		
		

		<a href="community/{{ $link->category->slug }}" class="label label-default" style="background: {{ $link->category->color }}">{{ $link->category->title}} </a>
		<a href="{{$link->link}}" target="__blank">
			{{ $link->title }}
		</a> 
		<small>Contributed by <a href="">{{ $link->creator->name}} </a>  {{ $link->updated_at->diffForHumans() }}</small> 

	</li>
	@endforeach

	{{ $links->appends(request()->query())->links() }}

	@else
	<li class="list-group-item">No contributions yet.</li>

	@endif

</ul>

