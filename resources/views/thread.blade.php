@extends("layout")
@section("customStyles")

@endsection
@section("content")
{{--    {{dd($tweet->replies)}}--}}
    <thread :tweet='@json($tweet)' :user='@json(Auth::user())'></thread>
@endsection
