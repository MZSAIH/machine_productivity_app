@extends('layouts.app',['activePage' => 'user'])

@section('title','create a user')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Create new user')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('/user') }}">{{__('user')}}</a></div>
            <div class="breadcrumb-item">{{__('Create user')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('User management panel')}}</h2>
        <p class="section-lead">{{__('Create user')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('user') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="fullname">{{__('Full Name')}}</label>
                            <input type="text" name="fullname" class="form-control @error('fullname') is_invalide @enderror" id="" placeholder="{{__('Full Name')}}" required="" style="text-transform: none;">
                            @error('name')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="name">{{__('Username')}}</label>
                            <input type="text" name="username" class="form-control @error('username') is_invalide @enderror" id="" placeholder="{{__('Username')}}" required="" style="text-transform: none;">
                            @error('username')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label for="password">{{__('password')}}</label>
                            <input type="password" name="password" class="form-control @error('password') is_invalide @enderror" id="" placeholder="{{__('* * * * * *')}}" required="" style="text-transform: none;">
                            @error('password')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label for="role">{{__('Roles')}}</label>
                            <select class="form-control select2" name="roles[]" id="">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->title == 'vendor' ? 'disabled' : ''  }}>{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('Add user')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
