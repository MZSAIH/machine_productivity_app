@extends('layouts.app',['activePage' => 'operation'])

@section('title','Operation')

@section('content')
    <script type="text/javascript">
        window.onload = () =>
        {
            $(".main-sidebar").niceScroll();
        }
    </script>
<section class="section">
    <div class="section-header">
        <h1>{{ __('Machine #').$machine->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Operation')}}</div>
            </div>
        </div>
    </div>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card profile-widget">
                <div class="profile-widget-header section-header">
                    <h3>Order details</h3>
                    <div class="w-100">
                        <a href="{{ url('production') }}" class="btn btn-primary float-right">{{__('All orders')}}</a>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
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
   </div>

    <div class="section-body">
        <h2 class="section-title">{{__('Actions')}}</h2>
        <p class="section-lead">{{__('Actions within production #').$production->id}}</p>
        <div class="card">
            <div class="card-header">
                <div class="w-100">
                    <a href="{{ url('operation/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>{{__('Add action')}}</a>
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
                        @foreach ($production['actions'] as $action)
                            <tr>
                                <td>
                                    <input name="id[]" value="{{$action->id}}" id="{{$action->id}}" data-id="{{ $action->id }}" class="sub_chk" type="checkbox" />
                                    <label for="{{$action->id}}"></label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $action->name }}</td>
                                <td>{{ $action->pivot->user_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</section>
@endsection
