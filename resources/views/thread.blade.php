@extends("layout")
@section("customStyles")

@endsection
@section("content")
    <thread :tweet='@json($tweet)' :user='@json(Auth::user())'></thread>
@endsection
