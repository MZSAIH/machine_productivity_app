@extends('layouts.app',['activePage' => 'action'])

@section('title','create a action')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Create new action')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('/action') }}">{{__('action')}}</a></div>
            <div class="breadcrumb-item">{{__('Create action')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('Action management panel')}}</h2>
        <p class="section-lead">{{__('Create action')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('action') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="number">{{__('Action number')}}</label>
                            <input type="text" name="number" class="form-control @error('number') is_invalide @enderror" id="" placeholder="{{__('Action number')}}" value="{{old('name')}}" required="" style="text-transform: none;">
                            @error('number')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control @error('name') is_invalide @enderror"P placeholder="{{__('Name')}}" value="{{old('name')}}" required="" style="text-transform: none;">
                            @error('name')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('Add action')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
