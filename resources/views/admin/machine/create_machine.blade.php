@extends('layouts.app',['activePage' => 'machine'])

@section('title','create a machine')

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
                <form class="container-fuild" action="{{ url('machine') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{__('Machine name')}}</label>
                            <input type="text" name="name" class="form-control @error('name') is_invalide @enderror" id="" placeholder="{{__('Machine name')}}" value="{{old('name')}}" required="" style="text-transform: none;">
                            @error('name')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
