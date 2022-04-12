@extends('layouts.app',['activePage' => 'production'])

@section('title','create a production')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Create new machine')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('admin/machine') }}">{{__('machine')}}</a></div>
            <div class="breadcrumb-item">{{__('Create machine')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('machine management panel')}}</h2>
        <p class="section-lead">{{__('Create machine')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('admin/machine') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{__('Production name')}}</label>
                            <input type="text" name="name" class="form-control @error('name') is_invalide @enderror" id="" placeholder="{{__('machine name')}}" value="{{old('name')}}" required="" style="text-transform: none;">
                            @error('title')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email">{{__('email')}}</label>
                            <input type="email" name="email_id" class="form-control @error('email_id') is_invalide @enderror"P placeholder="{{__('email')}}" value="{{old('email')}}" required="" style="text-transform: none;">
                            @error('email_id')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="phone">{{__('phone')}}</label>
                            <input type="number" name="phone" class="form-control @error('phone') is_invalide @enderror" id="" placeholder="{{__('phone')}}" value="{{old('phone')}}" required="" style="text-transform: none;">
                            @error('phone')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="password">{{__('password')}}</label>
                            <input type="password" name="password" class="form-control @error('password') is_invalide @enderror" id="" placeholder="{{__('* * * * * *')}}" value="{{old('password')}}" required="" style="text-transform: none;">
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
                        <button class="btn btn-primary" type="submit">{{__('Add machine')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
