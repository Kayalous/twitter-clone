@extends("layout")
@section("customStyles")

@endsection
@section("content")
    <twitter-app :user='@json(Auth::user())'></twitter-app>
@endsection
