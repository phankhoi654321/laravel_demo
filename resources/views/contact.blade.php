@extends('layouts.app')

@section('content')

    <h1>Hello from contact</h1>
    @if(count($people))
        {{count($people)}}
        <ul style="width: fit-content">
            @foreach($people as $person)
                <li>{{$person}}</li>
            @endforeach
        </ul>
    @endif

    {{--@component('alert')--}}
        {{--<strong>Whoops!</strong> Something went wrong!--}}
    {{--@endcomponent--}}

    @component('alert')
        @slot('title')
            Forbidden
        @endslot

        You are not allowed to access this resource!
    @endcomponent


@endsection