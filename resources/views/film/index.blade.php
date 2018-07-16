@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id='films'>
    </div>
</div>
@endsection
@section('javascript')
    <script src="{{ URL::asset('js/films.js') }}"></script>
@endsection

