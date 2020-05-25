@extends("layout")
@section("customStyles")

@endsection
@section("content")
{{--    @json(\App\Tweet::all())--}}
    <twitter-app :user='@json(Auth::user())' :tweets='@json(\App\Tweet::all())'></twitter-app>
@endsection
