@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Հաստատեք Ձեր էլեկտրոնային հասցեն</h2>

    <p>
        Մենք Ձեզ ուղարկել ենք հաստատման նամակ։
        Խնդրում ենք բացել նամակը և սեղմել հաստատման հղումը։
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="btn btn-primary">
            Կրկին ուղարկել հաստատման նամակը
        </button>
    </form>
</div>
@endsection