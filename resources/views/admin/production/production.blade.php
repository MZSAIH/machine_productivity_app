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
                    //console.log(msg);
            });
            </script>
            @endif
            <div class="section-header">
                <h1>{{__('productions')}}</h1>

                <div class="section-header-breadcrumb">
                    <div class="section-header-breadcrumb">

                        @if(Auth::user()->load('roles')->roles->contains('title', 'operator'))
                        <div class="right">
                            <form id="back" action="{{ url('operation') }}" method="GET">
                                @csrf
                                <input type="hidden" name='machine_id' value="{{ $machine_id }}">
                            </form>
                            <a href="" onclick="event.preventDefault(); document.getElementById('back').submit();" class="btn btn-primary"><i class="fas fa-arrow-left "></i></a>
                            &nbsp;
                            <a href="/home" class="btn btn-primary"><i class="fas fa-home "></i></a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{__('Manage productions')}}</h2>
                <p class="section-lead">{{__('Manage productions.')}}</p>
                <div class="card">
                    <div class="card-header">
                        @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                        <div class="w-100">
                            <a href="{{ url('/production/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>{{__('  Add production')}}</a>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    {{-- <th>
                                        <input name="select_all" value="1" id="master" type="checkbox" />
                                        <label for="master"></label>
                                    </th> --}}
                                    <th>#</th>
                                    <th>{{__('production code')}}</th>
                                    <th>{{__('Article code')}}</th>
                                    <th>{{__('Article desc')}}</th>
                                    <th>{{__('Stampo')}}</th>
                                    @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                                    <th>{{__('Machine')}}</th>
                                    @endif
                                    <th>{{__('Starting date')}}</th>
                                    <th>{{__('Ending date')}}</th>
                                    <th>{{__('Objectif')}}</th>
                                    @if(Auth::user()->load('roles')->roles->contains('title', 'operator'))
                                    <th>{{__('Open')}}</th>
                                    @endif
                                    @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productions as $production)
                                    <tr>


                                        {{-- <td>
                                            <input name="id[]" value="{{$production->id}}" id="{{$production->id}}" data-id="{{ $production->id }}" class="sub_chk" type="checkbox" />
                                            <label for="{{$production->id}}"></label>
                                        </td> --}}
                                        <td @class([
                                            'prod_finished' => $production->status == 'F',
                                            'prod_paused' => $production->status == 'P',
                                            'prod_running' => $production->status == 'C',
                                            'prod_initial' => $production->status == 'I'
                                        ])>{{ $loop->iteration }}</td>
                                        <td>{{ $production->order_id }}</td>
                                        <td>{{ $production->code_article }}</td>
                                        <td>{{ $production->desc_article }}</td>
                                        <td>{{ $production->stampo }}</td>
                                        @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                                        <td>
                                        <select class="form-control w-auto" onchange="change_machine_prod({{ $production->id }})" name="machine_prod_change" id="machine_prod{{$production->id}}">
                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}" {{ $machine->id == $production->machine->id ? 'selected' : '' }}>{{ $machine->name }}</option>
                                            @endforeach
                                        </select>
                                        </td>
                                        @endif
                                        <td>{{ $production->starting_date }}</td>
                                        <td>{{ $production->ending_date }}</td>
                                        <td><strong>{{ $production->production_lotto }}&nbsp;/&nbsp;{{ $production->objectif }}</strong></td>
                                        @if(Auth::user()->load('roles')->roles->contains('title', 'operator'))
                                            <td>
                                                {{-- @i f($production->status == 'P' || $production->status == 'I') --}}
                                                    <a href="" class="btn btn-primary btn-action mr-1" onclick="event.preventDefault(); change_production({{ $production->id }});"><i class="fas fa-newspaper"></i></a>
                                                {{-- @endif --}}
                                            </td>
                                        @endif
                                        @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                                            <td>
                                                <form id="export{{ $production->id }}" action="production/export" method="POST">
                                                    @csrf
                                                    <input type="hidden" name='production_id' value="{{ $production->id }}">
                                                </form>
                                                <a onclick="event.preventDefault(); document.getElementById('export{{ $production->id }}').submit();"  class="btn btn-success btn-action mr-1" ><i class="fas fa-file"></i> Download</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{-- <input type="button" value="Delete selection" onclick="deleteAll('production_multi_delete','production')" class="btn btn-primary"> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
