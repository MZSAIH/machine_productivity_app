@extends('layouts.app',['activePage' => 'dashboard'])

@section('title','create a opeartion')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Add scarto')}}</h1>
        <div class="section-header-breadcrumb">
            <form id="back" action="{{ url('operation') }}" method="GET">
                @csrf
                <input type="hidden" name='machine_id' value="{{ $machine->id }}">
            </form>
            <a href="" onclick="event.preventDefault(); document.getElementById('back').submit();" class="btn btn-primary"><i class="fas fa-arrow-left "></i></a>
            &nbsp;
            <a href="/home" class="btn btn-primary"><i class="fas fa-home "></i></a>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('Production management panel')}}</h2>
        <p class="section-lead">{{__('Add scarto')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('operation/store_scarto') }}" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                        <input type="hidden" name='production_id' value="{{ $production->id }}">
                        <input type="hidden" name='user_id' value="{{ Auth::user()->id }}">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="name">{{__('Machine name')}}</label>
                            <input type="text" disabled name="name" class="form-control @error('name') is_invalide @enderror" id="" placeholder="{{__('Machine name')}}" value="{{$machine->name}}" required="" style="text-transform: none;">
                            @error('machine_id')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="name">{{__('Production code')}}</label>
                            <input type="text" disabled name="name" class="form-control @error('name') is_invalide @enderror" id="" placeholder="{{__('Productin code')}}" value="{{$production->order_id}}" required="" style="text-transform: none;">
                            @error('production_id')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="scarto">{{__('Scarto')}}</label>
                            <input type="number" name="scarto" class="form-control @error('scarto') is_invalide @enderror" id="" placeholder="{{__('Scarto')}}" value="{{ $production->scarto }}" required="" min="{{ $production->scarto }}" style="text-transform: none;">
                            @error('scarto')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="scarto_pr">{{__('Scarto Pr')}}</label>
                            <input type="text" name="scarto_pr" class="form-control @error('scarto_pr') is_invalide @enderror" id="" placeholder="{{__('Motif')}}" value="" required="" style="text-transform: none;">
                            @error('scarto_pr')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('Add scarto')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
