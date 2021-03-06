@extends('layouts.app',['activePage' => 'production'])

@section('title','Edit production')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Edit machine')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ url('/machine') }}">{{__('machine')}}</a></div>
            <div class="breadcrumb-item">{{__('Edit machine')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('machine management panel')}}</h2>
        <p class="section-lead">{{__('Edit machine')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('machine/'.$machine->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{__('machine name')}}</label>
                            <input type="text" name="name" class="form-control @error('name') is_invalide @enderror" id="" placeholder="{{__('machine name')}}" value="{{ $machine->name }}" required="" style="text-transform: none;">
                            @error('name')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email">{{__('email')}}</label>
                            <input type="email" name="email" class="form-control @error('email') is_invalide @enderror" id="" placeholder="{{__('email')}}" value="{{ $machine->email }}" readonly style="text-transform: none;">
                            @error('email')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="phone">{{__('phone')}}</label>
                            <input type="number" name="phone" class="form-control @error('phone') is_invalide @enderror" id="" placeholder="{{__('phone')}}" value="{{ $machine->phone }}" required="" style="text-transform: none;">
                            @error('phone')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="password">{{__('New password')}}</label>
                            <input type="password" name="password" class="form-control @error('password') is_invalide @enderror" id="" placeholder="{{__('* * * * * *')}}" value="{{old('password')}}" style="text-transform: none;">
                            @error('password')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="role">{{__('Roles')}}</label>

                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('update machine')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
