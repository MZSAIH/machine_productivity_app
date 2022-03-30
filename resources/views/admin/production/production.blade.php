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
                                    <tr>
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
                                        <td>{{ $production->status }}</td>
                                        {{-- <td>
                                            <label class="switch">
                                                <input type="checkbox" name="status" onclick="change_status('/production',{{ $production->id }})" {{($production->status == 1) ? 'checked' : ''}}>
                                                <div class="slider"></div>
                                            </label>
                                        </td>
                                        <!--if (Gate::check('production_edit') && Gate::check('production_access') && Gate::check('production_delete'))-->
                                        <td class="d-flex">
                                            <!--can('production_edit')-->
                                                <a href="{{ url('/production/'.$production->id.'/edit') }}" class="btn btn-primary btn-action mr-1 " data-toggle="tooltip" title="" data-original-title="{{__('Edit production')}}"><i class="fas fa-pencil-alt"></i></a>
                                            <!--endcan-->
                                            <!--can('production_access')-->
                                                <a href="{{ url('/production/'.$production->id) }}" data-toggle="tooltip" title="" data-original-title="{{__('show production profile')}}" class="btn btn-primary btn-action mr-1"><i class="fas fa-eye"></i></a>
                                            <!--endcan-->
                                            <!--can('production_delete')-->
                                                <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('/production',{{ $production->id }},'production')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <!--endcan-->
                                        </td>
                                        <!--endif--> --}}

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
