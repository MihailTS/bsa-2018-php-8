@extends('layout')

@section('title')
{{$title}}
@endsection

@section('content')
    <form action="{{ route('currencies.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="currency">
            <div class="row">
                <div class="currency__field">
                    <div class="input-field currency__field col s12">
                        <input name="title" type="text" id="currency__name" class="currency-field__value"
                               value="{{old('title')}}"/>
                        <label for="currency__name" class="currency-field__name">Name:</label>

                        @if($errors->has('title'))
                            <div class="helper-text red-text">{{$errors->first('title')}}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="currency__field">
                    <div class="input-field currency__field col s12">
                        <input name="short_name" type="text" id="currency__short-name" class="currency-field__value"
                               value="{{old('short_name')}}"/>
                        <label for="currency__short-name" class="currency-field__name">Short name:</label>
                        @if($errors->has('short_name'))
                            <div class="helper-text red-text">{{$errors->first('short_name')}}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="currency__field">
                    <div class="input-field currency__field col s12">
                        <input name="logo_url" type="text" id="currency__logo-url" class="currency-field__value"
                               value="{{old('logo_url')}}"/>
                        <label for="currency__logo-url" class="currency-field__name">Logo URL:</label>
                        @if($errors->has('logo_url'))
                            <div class="helper-text red-text">{{$errors->first('logo_url')}}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="input-field currency__field col s12">
                    <input name="price" type="text" id="currency__price" class="currency-field__value"
                           value="{{old('price')}}"/>
                    <label for="currency__price" class="currency-field__name">Price:</label>

                    @if($errors->has('price'))
                        <div class="helper-text red-text">{{$errors->first('price')}}</div>
                    @endif
                </div>
            </div>
            <input type="submit" class="btn" value="Save" />
        </div>
    </form>
@endsection
