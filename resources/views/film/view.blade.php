@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 mb-2">
            <div class="card" id='films-view'>
                
            </div>
            <hr>
            <div class="form-comment">
                <form action="" method="POST" id="form-comment-film">
                    <input type="text" name="comment-film" id='comment-film'>
                    <input type="submit">
                </form>
               
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script src="{{ URL::asset('js/films_view.js') }}"></script>
@endsection

