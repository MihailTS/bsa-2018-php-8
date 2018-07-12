@extends('layout')

@section('title')
{{$title}}
@endsection

@section('content')
    <h1>{{$title}}</h1>
    @if(Session::has('success_msg'))

        <div class="card green">
            <div class="card-content white-text">{{ Session::get('success_msg') }}</div>
        </div>
    @endif
    <table class="currency-show-table">
        <colgroup>
            <col span="1" style="width: 40%;">
            <col span="1" style="width: 60%;">
        </colgroup>
        <tr class="currency__field">
            <td class="currency-field__name">Name:</td>
            <td class="currency-field__value">{{$currency->title}}</td>
        </tr>
        <tr class="currency__field">
            <td class="currency-field__name">Short name:</td>
            <td class="currency-field__value">{{$currency->short_name}}</td>
        </tr>
        <tr class="currency__field">
            <td class="currency-field__name">Logo:</td>
            <td class="currency-field__value"><img src="{{$currency->logo_url}}" alt="{{$currency->title}}"/> </td>
        </tr>
        <tr class="currency__field">
            <td class="currency-field__name">Price</td>
            <td class="currency-field__value">{{$currency->price}}</td>
        </tr>
    </table>

    <form class="currency-delete-form" action="{{ route('currencies.destroy',$currency->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <a class="btn edit-button" href="{{route('currencies.edit',$currency->id)}}">Edit</a>
        <button class="btn red delete-button" type="submit" >Delete</button>
    </form>
@endsection
