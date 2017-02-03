@extends('layouts.material')

@section('title', $user->name)

@section('content')
<div class="container">

	<br>
		<div class="row">
			<div class="col s3 m1">	
				<img height="85" src="{{ $user->getCorpImage() }}"> 
			</div>
			<div class="col s9 m11">
				<h5>{{ $user->name }}</h5>
				<span>{{ $user->getCorpName() }} <span class="right"><small>{{ trans('messages.profile_member_since', ['ago' => $user->getCreatedDiff()]) }}</small></span></span>

			</div>
		</div>
		
		<div class="card-panel">
			<div class="row">
				<div class="col s3 m1">	
					<img height="85" src="{{ $user->getRankImage() }}"> 
				</div>
				<div class="col s9 m11">
					<span class="flow-text">{{ $user->getRankName() }}</span><br>

				</div>
			</div>
		</div>
	
		
		<div class="card-panel">
			<?php $cuenta = 0; ?>
          @foreach($user->specialties()->get() as $specialty)
          @can('view-secret-specialty', $specialty)
          <?php $cuenta++; ?>
          <a href="{{ route('specialty-view', ['id' => $specialty->id]) }}" class="tooltipped" data-position="top" data-delay="50" data-tooltip="{{ $specialty->acronym }}"><img height="70" src="/img/divisas/especialidades/{{ $specialty->id }}.png" alt="{{ $specialty->acronym }}"></a>
          @endcan
          @endforeach
			
			@if($cuenta == 0)
				<p>{{ trans('messages.profile_specialties_none') }}</p>
			@endif
		</div>
		
		@if( Auth::user()->id != $user->id)
		<a href="{{ route('ticket_new', ['id' => $user->id]) }}" class="btn grey darken-1 waves-effect">{{ trans('messages.profile_complaint_button') }}</a>
		@endif

		@if(Auth::user()->id == $user->id || Auth::user()->isMando())
		<span class="right"><small><a href="#modalerror">{{ trans('messages.profile_error') }}</a></small></span>
		@endif
		 
		  

		  <!-- Modal Structure -->
		  <div id="modalerror" class="modal">
		    <div class="modal-content">
		      <h4>{{ trans('messages.profile_error_modal_title') }}</h4>
		      <p>{{ trans('messages.profile_error_modal_description') }}</p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect btn-flat">{{ trans('messages.profile_error_modal_close') }}</a>
		    </div>
		  </div>
		
		@can('admin')	
		<br><br>
		<span class="right">
		<a href="/admin/user/{{ $user->id }}/edit" class="btn black white-text waves-effect waves-light"><i class="material-icons left">developer_mode</i> {{ trans('messages.profile_admin_edit') }}</a>
		</span>
		@endcan
		
</div>
@endsection