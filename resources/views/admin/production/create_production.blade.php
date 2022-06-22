@extends('layouts.app',['activePage' => 'production'])

@section('title','create a production')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Create new production')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="right">

            </div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('Production management')}}</h2>
        <p class="section-lead">{{__('Create Production')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('production/store') }}" method="post">
                    @csrf
                    <input type="hidden" name="is_crlf" value="x">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="machine_id">{{__('Machine')}}</label>
                            <select class="form-control select2" name="machine_id" id="select_action">
                                @foreach ($machines as $machine)
                                    <option value="{{ $machine->id }}"> {{ $machine->name  }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="order_id">{{__('Order Id')}}</label>
                            <input type="text" name="order_id" class="form-control @error('order_id') is_invalide @enderror" id="" placeholder="{{__('Order Id')}}" required="" style="text-transform: none;">
                            @error('order_id')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="code_article">{{__('Code Article')}}</label>
                            <input type="text" name="code_article" class="form-control @error('code_article') is_invalide @enderror"P placeholder="{{__('Code Article')}}" required="" style="text-transform: none;">
                            @error('code_article')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="desc_article">{{__('Description Article')}}</label>
                            <input type="text" name="desc_article" class="form-control @error('desc_article') is_invalide @enderror"P placeholder="{{__('Description Article')}}"  required="" style="text-transform: none;">
                            @error('desc_article')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="stampo">{{__('Stampo')}}</label>
                            <input type="number" name="stampo" class="form-control @error('stampo') is_invalide @enderror" id="" placeholder="{{__('Stampo')}}" required="" style="text-transform: none;">
                            @error('stampo')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="objectif">{{__('Objectif')}}</label>
                            <input type="number" name="objectif" class="form-control @error('objectif') is_invalide @enderror"P placeholder="{{__('Objectif')}}" required="" style="text-transform: none;">
                            @error('objectif')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('Add production')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
