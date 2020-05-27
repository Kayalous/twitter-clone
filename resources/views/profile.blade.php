@extends("layout")
@section("customStyles")

@endsection
@section("content")
    <profile :tweeter='@json($user)' :user='@json(Auth::user())'></profile>
@endsection
