@extends('layouts.app',['activePage' => 'user'])

@section('title','User Profile')

@section('content')

<section class="section">
    <div class="section-header">
    <h1>{{__('User profile')}}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
        <div class="breadcrumb-item active"><a href="{{ url('admin/user') }}">{{__('user')}}</a></div>
        <div class="breadcrumb-item">{{__('User Profile')}}</div>
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
                <div class="profile-widget-header">
                    <img alt="image" src="{{ $user->image }}" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">{{__('Total order')}}</div>
                            <div class="profile-widget-item-value">{{ count($orders) }}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">{{__('Pending')}}</div>
                            <div class="profile-widget-item-value">{{ count($pending_orders) }}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">{{__('Approve')}}</div>
                            <div class="profile-widget-item-value">{{ count($complete_orders) }}</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{__('User Name')}} : {{ $user->name }}<br>
                        {{__('Phone number')}} : {{ $user->phone }}<br>
                        {{__('Email')}} : {{ $user->email_id }}<br>
                    </div>
                </div>
            </div>
        </div>
   </div>
   <div class="row mt-sm-4">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $user->name }}  {{__('order details')}}</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                aria-selected="false">{{__('All')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">{{__('Approve')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="true">{{__('Pending')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Order Id')}}</th>
                                        <th>{{__('Vendor name')}}</th>
                                        <th>{{__('User Name')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Time')}}</th>
                                        <th>{{__('Order Status')}}</th>
                                        <th>{{__('Payment status')}}</th>
                                        <th>{{__('View')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$order->order_id}}</td>
                                            <td>{{ $order['vendor']->name }}</td>
                                            <td>{{ $order['user']->name }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->time }}</td>
                                            <td>
                                                @if ($order->order_status == 'PENDING')
                                                    <span class="badge badge-pill pending">{{__('PENDING')}}</span>
                                                @endif

                                                @if ($order->order_status == 'APPROVE')
                                                    <span class="badge badge-pill approve">{{__('APPROVE')}}</span>
                                                @endif

                                                @if ($order->order_status == 'REJECT')
                                                    <span class="badge badge-pill reject">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'CANCEL')
                                                    <span class="badge badge-pill cancel">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'PICKUP')
                                                    <span class="badge badge-pill pickup">{{__('PICKUP')}}</span>
                                                @endif

                                                @if ($order->order_status == 'DELIVERED')
                                                    <span class="badge badge-pill delivered">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'COMPLETE')
                                                    <span class="badge badge-pill complete">{{__('COMPLETE')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->payment_status == 1)
                                                    <div class="span">{{__('payment complete')}}</div>
                                                @endif

                                                @if ($order->payment_status == 0)
                                                    <div class="span">{{__('payment not complete')}}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/order/'.$order->id) }}" onclick="show_admin_order({{ $order->id }})" data-toggle="modal" data-target="#view_order">{{__('View Order')}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Order Id')}}</th>
                                        <th>{{__('Vendor name')}}</th>
                                        <th>{{__('User Name')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Time')}}</th>
                                        <th>{{__('Order Status')}}</th>
                                        <th>{{__('Payment status')}}</th>
                                        <th>{{__('View')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approve_orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$order->order_id}}</td>
                                            <td>{{ $order['vendor']->name }}</td>
                                            <td>{{ $order['user']->name }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->time }}</td>
                                            <td>
                                                @if ($order->order_status == 'PENDING')
                                                    <span class="badge badge-pill pending">{{__('PENDING')}}</span>
                                                @endif

                                                @if ($order->order_status == 'APPROVE')
                                                    <span class="badge badge-pill approve">{{__('APPROVE')}}</span>
                                                @endif

                                                @if ($order->order_status == 'REJECT')
                                                    <span class="badge badge-pill reject">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'CANCEL')
                                                    <span class="badge badge-pill cancel">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'PICKUP')
                                                    <span class="badge badge-pill pickup">{{__('PICKUP')}}</span>
                                                @endif

                                                @if ($order->order_status == 'DELIVERED')
                                                    <span class="badge badge-pill delivered">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'COMPLETE')
                                                    <span class="badge badge-pill complete">{{__('COMPLETE')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->payment_status == 1)
                                                    <div class="span">{{__('payment complete')}}</div>
                                                @endif

                                                @if ($order->payment_status == 0)
                                                    <div class="span">{{__('payment not complete')}}</div>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ url('admin/order/'.$order->id) }}" onclick="show_admin_order({{ $order->id }})" data-toggle="modal" data-target="#view_order">{{__('View Order')}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Order Id')}}</th>
                                        <th>{{__('Vendor name')}}</th>
                                        <th>{{__('User Name')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Time')}}</th>
                                        <th>{{__('Order Status')}}</th>
                                        <th>{{__('Payment status')}}</th>
                                        <th>{{__('View')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pending_orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$order->order_id}}</td>
                                            <td>{{ $order['vendor']->name }}</td>
                                            <td>{{ $order['user']->name }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->time }}</td>
                                            <td>
                                                @if ($order->order_status == 'PENDING')
                                                    <span class="badge badge-pill pending">{{__('PENDING')}}</span>
                                                @endif

                                                @if ($order->order_status == 'APPROVE')
                                                    <span class="badge badge-pill approve">{{__('APPROVE')}}</span>
                                                @endif

                                                @if ($order->order_status == 'REJECT')
                                                    <span class="badge badge-pill reject">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'CANCEL')
                                                    <span class="badge badge-pill cancel">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'PICKUP')
                                                    <span class="badge badge-pill pickup">{{__('PICKUP')}}</span>
                                                @endif

                                                @if ($order->order_status == 'DELIVERED')
                                                    <span class="badge badge-pill delivered">{{__('REJECT')}}</span>
                                                @endif

                                                @if ($order->order_status == 'COMPLETE')
                                                    <span class="badge badge-pill complete">{{__('COMPLETE')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->payment_status == 1)
                                                    <div class="span">{{__('payment complete')}}</div>
                                                @endif

                                                @if ($order->payment_status == 0)
                                                    <div class="span">{{__('payment not complete')}}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/order/'.$order->id) }}" onclick="show_admin_order({{ $order->id }})" data-toggle="modal" data-target="#view_order">{{__('View Order')}}</a>
                                            </td>
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
