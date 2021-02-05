@extends('layouts.app')
@section('title', 'Eagle Bug Tracker')
@section('content')

<div> 
     {{-- Vue Js App --}}
     <div id="app">
        @if(Auth::check())
            <dashboard :user="{{Auth::user()}}" :token=`{{Auth::user()->authentication_token}}`></dashboard>
        @else
            <dashboard :user="false" :token="null"></dashboard>
        @endif
    </div>       
</div>
@endsection


