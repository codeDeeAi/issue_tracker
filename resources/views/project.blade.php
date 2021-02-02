@extends('layouts.app')
@section('title', 'Aveon Issue Tracker')
@section('content')


<div> 
     {{-- Vue Js App --}}
     <div id="app">
        @if(Auth::check())
            <project :user="{{Auth::user()}}" :token=`{{Auth::user()->authentication_token}}` :project_id={{$id}} :project_name="`{{$name}}`" ></project>
        @else
            <project :user="false" :token="null" :project_id="false" :project_name="false"></project>
        @endif
    </div>       
</div>
@endsection


