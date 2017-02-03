@extends('layouts.material')

@section('title', trans('messages.home_title'))

@section('content')
<div class="section">
    <div class="container">
    	<div class="row">
	    	@foreach($links as $link)
	    		<div class="col s6 m3">
	    			<a href="{{ url($link[1]) }}">
		    			<div class="card-panel hoverable">
		    				<i class="left material-icons">{{ $link[2] }}</i> {{ $link[0] }}	
		    			</div>
	    			</a>
	    		</div>
			@endforeach
    	</div>
		
        @can('admin-tickets')
        @if($tickets_open > 0)
        <p><img height="16" src="/img/divisas/especialidades/6.png"> {{ trans('messages.home_tickets_waiting') }}</p>
        <div class="card-panel">
            <p><a href="{{ route('tickets') }}">{{ trans_choice('messages.home_tickets_waiting_content', $tickets_open, ['num' => $tickets_open]) }}</a></p>
        </div>
        @endif 
        @endcan

		@if($tickets->count() > 0)
    	<p>Tus tickets abiertos</p>
    		<ul>
    		@foreach($tickets as $ticket)
    		<a href="{{ route('ticket', ['id' => $ticket->id]) }}">
    		<div class="card-panel hoverable">
    			<div class="row">
    				<div class="col s12 m6">
    					<span><b>{{ $ticket->title }}</b></span>
    					<br><span>{{ $ticket->getCreatedDiff() }}</span>
    				</div>
    				<div class="col s12 m6">
    					<span>{!! trans_choice('messages.home_tickets_open_replies', $ticket->replies->count(), ['num' => $ticket->replies->count()]) !!}
    					@if($ticket->replies->count() > 0) 
    					({{ $ticket->getLastReply()->getCreatedDiff() }})</span>
    					@endif
    					<br><span><i class="material-icons tiny">{{ $ticket->getStatus()['icon'] }}</i> {{ $ticket->getStatus()['text'] }}</span>
    				</div>
    			</div>
    		</div>
    		</a>
    		@endforeach
    		</ul>
    	@endif
    </div>
</div>

@endsection
