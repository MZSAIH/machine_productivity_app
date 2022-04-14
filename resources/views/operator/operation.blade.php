@extends('layouts.app',['activePage' => 'operation'])

@section('title','Operation')

@section('content')
    <script type="text/javascript">
        window.onload = () =>
        {
            $(".main-sidebar").niceScroll();
        }
    </script>
    @if (Session::has('msg'))
    <script>
            var msg = "<?php echo Session::get('msg'); ?>"
        $(window).on('load', function()
        {
            iziToast.success({
                message: msg,
                position: 'topRight'
            });
            console.log(msg);
    });
    </script>
    @endif
<section class="section">
    <div class="section-header">
        <h1>{{ __('Machine #').$machine->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <a href="/home" class="btn btn-primary">Go back</a>
            </div>
        </div>
    </div>

    <div class="row mt-sm-4">
        @if( $production != null && $production->status == 'C' )
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card profile-widget">
                <div class="profile-widget-header section-header">
                    <h3>Current Order Details</h3>
                    <div class="w-100">
                        <form id="machine_prod" action="{{ url('production_machine') }}" method="POST">
                            @csrf
                            <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                            <a href="" onclick="event.preventDefault(); document.getElementById('machine_prod').submit();" class="btn btn-primary float-right">{{__('All orders')}}</a>
                        </form>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{__('Production #')}} : {{ $production->id }}<br>
                        {{__('Order id')}} : {{ $production->order_id }}<br>
                        {{__('Article code')}} : {{ $production->phone }}<br>
                        {{__('Article')}} : {{ $production->desc_article }}<br>
                        {{__('Stampo')}} : {{ $production->stampo }}<br>
                        {{__('Ending date')}} : {{ $production->ending_date }}<br>
                        {{__('Quantity')}} : {{ $production->objectif }}<br>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-6 col-md-12 col-lg-6">
            <div class="card profile-widget">
                <canvas id="progressChart" width="400" height="400"></canvas>
            </div>
        </div> --}}
        @else
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary rounded-lg" style="padding: 20px">
                <div class="row">
                    <div class="col-9 col-md-9 col-lg-9">
                        <h3>No current order</h3>
                    </div>
                    <div class="col-3 col-md-3 col-lg-3">
                        <div class="w-100">
                            <div class="row">
                                <form id="machine_prod" action="{{ url('production_machine') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                                    <a href="" onclick="event.preventDefault(); document.getElementById('machine_prod').submit();" class="btn btn-primary float-right">{{__('All orders')}}</a>
                                </form>
                            </div>
                            <div class="row">
                                <form id="create_prod" action="{{ url('add_operation') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                                    <input type="hidden" name='operation_id' value="{{ 74 }}">
                                    <a href="" onclick="event.preventDefault(); document.getElementById('machine_prod').submit();" class="btn btn-primary float-right">{{__('Create new order')}}</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif
   </div>

@if( $production != null  && $production->status == 'C' )
    <div class="section-body">
        <h2 class="section-title">{{__('Actions')}}</h2>
        <p class="section-lead">{{__('Actions within production #').$production->id}}</p>
        <div class="card">
            <div class="card-header">
                <div class="w-100">
                    <form id="add_op" action="operation/create" method="POST">
                        @csrf
                        <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                        <input type="hidden" name='production_id' value="{{ $production->id }}">
                        <a href="" onclick="event.preventDefault(); document.getElementById('add_op').submit();" class="btn btn-primary float-right">{{__('Add operation')}}</a>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <input name="select_all" value="1" id="master" type="checkbox" />
                                <label for="master"></label>
                            </th>
                            <th>#</th>
                            <th>{{__('Action')}}</th>
                            <th>{{__('User')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actions as $action)
                            <tr>
                                <td>
                                    <input name="id[]" value="{{$action->id}}" id="{{$action->id}}" data-id="{{ $action->id }}" class="sub_chk" type="checkbox" />
                                    <label for="{{$action->id}}"></label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $action->name }}</td>
                                <td>{{ $action->user_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
</section>
@endsection
