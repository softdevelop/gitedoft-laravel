@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new film') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('api/films') }}" aria-label="{{ __('Create') }}" id="film-create-ajax" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">{{ __('Film name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <span class="text-danger" id="error-create-name"></span> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                               @endif
                                <span class="text-danger" id="error-create-description"></span> 

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Realease date') }}</label>

                            <div class="col-md-6">
                                <input id="realease_date" type="date" class="form-control{{ $errors->has('realease_date') ? ' is-invalid' : '' }}" name="realease_date" required>

                                @if ($errors->has('realease_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('realease_date') }}</strong>
                                    </span>
                               @endif
                                <span class="text-danger" id="error-create-realease_date"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>

                            <div class="col-md-6">
                                <input id="rating" type="number" min="1" max="5" step="0.1" class="form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" name="rating" required>

                                @if ($errors->has('rating'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                               @endif
                                <span class="text-danger" id="error-create-rating"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Ticket price') }}</label>

                            <div class="col-md-6">
                                <input id="ticket_price" type="number" class="form-control{{ $errors->has('ticket_price') ? ' is-invalid' : '' }}" min="0" name="ticket_price" required>

                                @if ($errors->has('ticket_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket_price') }}</strong>
                                    </span>
                               @endif
                                <span class="text-danger" id="error-create-ticket_price"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" required>

                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                               @endif
                                <span class="text-danger" id="error-create-country"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Genre') }}</label>

                            <div class="col-md-6">
                                <div id="checkbox-genre">
                                    <input type="checkbox" name="genre[]" name="genre" value="Action"> Action<br>
                                    <input type="checkbox" name="genre[]" name="genre" value="Commedy"> Commedy<br>
                                    <input type="checkbox" name="genre[]" name="genre" value="Fiction"> Fiction<br>
                                    <input type="checkbox" name="genre[]" name="genre" value="Army"> Army<br>
                                </div>
                                
                                @if ($errors->has('genre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                               @endif
                                <span class="text-danger" id="error-create-genre"></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photo" required>

                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                               @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script src="{{ URL::asset('js/film_create.js') }}"></script>
@endsection

