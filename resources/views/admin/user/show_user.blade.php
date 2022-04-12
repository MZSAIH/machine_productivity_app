@extends('layouts.app',['activePage' => 'user'])

@section('title','User Profile')

@section('content')

<section class="section">
    <div class="section-header">
    <h1>{{__('User')}}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
        <div class="breadcrumb-item active"><a href="{{ url('admin/user') }}">{{__('user')}}</a></div>
        <div class="breadcrumb-item">{{__('User détails')}}</div>
    </div>
    </div>
    <div class="section-body">
    <h2 class="section-title">{{$user->name}}</h2>
    <p class="section-lead">
        {{__('Information about user')}}
    </p>

   <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card profile-widget">
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{__('Name')}} : {{ $user->name }}<br>
                        {{__('Username')}} : {{ $user->username }}<br>
                    </div>
                </div>
            </div>
        </div>
   </div>
   <div class="row mt-sm-4">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $user->name }}  {{__('productions')}}</h4>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Order Id')}}</th>
                                        <th>{{__('Code article')}}</th>
                                        <th>{{__('Article')}}</th>
                                        <th>{{__('Stampo')}}</th>
                                        {{-- <th>{{__('Machine')}}</th> --}}
                                        <th>{{__('Objectif')}}</th>
                                        <th>{{__('Lotto')}}</th>
                                        <th>{{__('Scarto')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productions as $production)
                                    <tr @class([
                                            'machine_finished' => $production->status == 'F',
                                            'machine_paused' => $production->status == 'P',
                                            'machine_operating' => $production->status == 'C',
                                            'machine_error' => $production->status == 'E',
                                            'machine_preparing' => $production->status == 'R'
                                        ])
                                    >
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$production->order_id}}</td>
                                            <td>{{$production->code_article}}</td>
                                            <td>{{$production->desc_article}}</td>
                                            <td>{{$production->stampo}}</td>
                                            {{-- <td>{{$production->machine->name}}</td> --}}
                                            <td>{{$production->objectif}}</td>
                                            <td>{{$production->production_lotto}}</td>
                                            <td>{{$production->scarto}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal right fade" id="view_order" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="staticBackdropLabel">{{__('View order')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>{{__('Order Id')}}</th>
                        <td class="show_order_id"></td>
                    </tr>
                    <tr>
                        <th>{{__('User name')}}</th>
                        <td class="show_user_name"></td>
                    </tr>
                    <tr>
                        <th>{{__('date')}}</th>
                        <td class="show_date"></td>
                    </tr>
                    <tr>
                        <th>{{__('time')}}</th>
                        <td class="show_time"></td>
                    </tr>
                    <tr>
                        <th>{{__('Delivery At')}}</th>
                        <td class="show_delivery_at"></td>
                    </tr>
                    <tr>
                        <th>{{__('Discount')}}</th>
                        <td class="show_discount"></td>
                    </tr>
                    <tr>
                        <th>{{__('Total Amount')}}</th>
                        <td class="show_total_amount"></td>
                    </tr>
                    <tr>
                        <th>{{__('Admin Commission')}}</th>
                        <td class="show_admin_commission"></td>
                    </tr>
                    <tr>
                        <th>{{__('Vendor Commission')}}</th>
                        <td class="show_vendor_amount"></td>
                    </tr>
                </table>
                <h6>{{__('tax')}}</h6>
                <table class="table TaxTable">
                </table>
                <h6>{{__('Items')}}</h6>
                <table class="table show_order_table">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>

@endsection
