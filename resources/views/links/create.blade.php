@extends('layouts.app')

@section('title', 'Create Link')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create Plugin
                    </div>

                    <div class="panel-body">
                        <form role="form" class="form" method="POST" action="{{ route('plugins.store') }}">
                            {{ csrf_field() }}
                            
                            {{ method_field('PATCH') }}

                            <div class="form-group{{ $errors->first('url', ' has-error') }}">
                                <label for="url" class="control-label">Url</label>

                                <input id="url" type="url" class="form-control" name="url" value="{{ old('url') }}" required autofocus />

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->first('code', ' has-error') }}">
                                <label for="code" class="control-label">Code</label>

                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" />

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Shorten
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
