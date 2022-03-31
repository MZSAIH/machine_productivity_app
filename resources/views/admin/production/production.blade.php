@extends('layouts.app',['activePage' => 'production'])

@section('title','productions')

@section('content')

<div class="row">
    {{-- <div class="col-lg-8 col-md-8 col-sm-12"> --}}
    <div class="col">
        <section class="section">
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
            <div class="section-header">
                <h1>{{__('productions')}}</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
                        <div class="breadcrumb-item">{{__('production')}}</div>
                    </div>
                </div> --}}
            </div>
            <div class="section-body">
                <h2 class="section-title">{{__('Manage productions')}}</h2>
                <p class="section-lead">{{__('Add, Edit, manage productions.')}}</p>
                <div class="card">
                    <div class="card-header">
                        <div class="w-100">
                            <a href="{{ url('/production/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>{{__('  Add')}}</a>
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
                                    <th>{{__('production code')}}</th>
                                    <th>{{__('Article code')}}</th>
                                    <th>{{__('Article desc')}}</th>
                                    <th>{{__('Stampo')}}</th>
                                    <th>{{__('Machine')}}</th>
                                    <th>{{__('Starting date')}}</th>
                                    <th>{{__('Ending date')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th>{{__('status')}}</th>
                                    {{-- <th>{{__('Activer')}}</th>
                                    <th>{{__('Action')}}</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productions as $production)
                                    {{-- <tr class="{{
                                        if($production->status == 'F')
                                            'prod_finished'
                                        elseif ($production->status == 'P')
                                            'prod_paused'
                                        else
                                            'prod_current'
                                    }}"> --}}
                                    <tr
                                    @class([
                                        'prod_finished' => $production->status == 'F',
                                        'prod_paused' => $production->status == 'P',
                                        'prod_current' => $production->status == 'C'
                                    ])>


                                        <td>
                                            <input name="id[]" value="{{$production->id}}" id="{{$production->id}}" data-id="{{ $production->id }}" class="sub_chk" type="checkbox" />
                                            <label for="{{$production->id}}"></label>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $production->order_id }}</td>
                                        <td>{{ $production->code_article }}</td>
                                        <td>{{ $production->desc_article }}</td>
                                        <td>{{ $production->stampo }}</td>
                                        <td>{{ $production->machine_id }}</td>
                                        <td>{{ $production->starting_date }}</td>
                                        <td>{{ $production->ending_date }}</td>
                                        <td><strong>{{ $production->objectif }}</strong></td>
                                        
                                            <td>
                                                @if($production->status == 'P')
                                                    <a href="{{ url('/production/'.$production->id.'/edit') }}" class="btn btn-primary btn-action mr-1 " data-toggle="tooltip" title="" data-original-title="{{__('Open')}}"><i class="fas fa-open"></i></a>
                                                @endif
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <input type="button" value="Delete selection" onclick="deleteAll('production_multi_delete','production')" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
