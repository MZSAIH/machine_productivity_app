@extends('layouts.app',['activePage' => 'machine'])

@section('title','Machines')

@section('content')

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
        <h1>{{__('machines')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Machine')}}</div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('gestion des machines')}}</h2>
        <p class="section-lead">{{__('Ajout, Modification, gestion machines.')}}</p>
        <div class="card">
            <div class="card-header">
                <div class="w-100">
                    <a href="{{ url('/machine/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>{{__('  Add')}}</a>
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
                            <th>{{__('Machine')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($machines as $machine)
                            <tr>
                                <td>
                                    <input name="id[]" value="{{$machine->id}}" id="{{$machine->id}}" data-id="{{ $machine->id }}" class="sub_chk" type="checkbox" />
                                    <label for="{{$machine->id}}"></label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $machine->name }}</td>
                                <td>
                                    <span @class([
                                        'machine_finished badge' => $machine->status == 'F',
                                        'machine_paused badge' => $machine->status == 'P',
                                        'machine_operating badge' => $machine->status == 'C',
                                        'machine_error badge' => $machine->status == 'E',
                                        'machine_preparing badge' => $machine->status == 'R'
                                    ])>&nbsp;&nbsp;&nbsp;</span>
                                </td>
                                <!--if (Gate::check('machine_edit') && Gate::check('machine_access') && Gate::check('machine_delete'))-->
                                <td class="d-flex">
                                    <!--can('machine_edit')-->
                                        <a href="{{ url('/machine/'.$machine->id.'/edit') }}" class="btn btn-primary btn-action mr-1 " data-toggle="tooltip" title="" data-original-title="{{__('Edit machine')}}"><i class="fas fa-pencil-alt"></i></a>
                                    <!--endcan-->
                                    <!--can('machine_access')-->
                                        <a href="{{ url('/machine/'.$machine->id) }}" data-toggle="tooltip" title="" data-original-title="{{__('show machine profile')}}" class="btn btn-primary btn-action mr-1"><i class="fas fa-eye"></i></a>
                                    <!--endcan-->
                                    <!--can('machine_delete')-->
                                        <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('/machine',{{ $machine->id }},'machine')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <!--endcan-->
                                </td>
                                <!--endif-->

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <input type="button" value="Supprimer la sélection" onclick="deleteAll('machine_multi_delete','machine')" class="btn btn-primary">
            </div>
        </div>
    </div>
</section>
@endsection
