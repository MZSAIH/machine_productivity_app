@extends('layouts.app',['activePage' => 'action'])

@section('title','actions')

@section('content')

<div class="row">
    {{-- <div class="col-lg-4 col-md-4 col-sm-12"> --}}
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
                <h1>{{__('Actions')}}</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
                        <div class="breadcrumb-item">{{__('action')}}</div>
                    </div>
                </div> --}}
            </div>
            <div class="section-body">
                <h2 class="section-title">{{__('Actions')}}</h2>
                <p class="section-lead">{{__('Add, Edit, manage actions.')}}</p>
                <div class="card">
                    <div class="card-header">
                        <div class="w-100">
                            <a href="{{ url('/action/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>{{__('  Add')}}</a>
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
                                    <th>{{__('Action code')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Action')}}</th>
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
                                        <td>{{ $action->number }}</td>
                                        <td>{{ $action->name }}</td>
                                        <!--if (Gate::check('action_edit') && Gate::check('action_access') && Gate::check('action_delete'))-->
                                        <td class="d-flex">
                                            <!--can('action_edit')-->
                                                <a href="{{ url('/action/'.$action->id.'/edit') }}" class="btn btn-primary btn-action mr-1 " data-toggle="tooltip" title="" data-original-title="{{__('Edit action')}}"><i class="fas fa-pencil-alt"></i></a>
                                            <!--endcan-->
                                            <!--can('action_access')-->
                                                {{-- <a href="{{ url('/action/'.$action->id) }}" data-toggle="tooltip" title="" data-original-title="{{__('show action profile')}}" class="btn btn-primary btn-action mr-1"><i class="fas fa-eye"></i></a> --}}
                                            <!--endcan-->
                                            <!--can('action_delete')-->
                                                <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('/action',{{ $action->id }},'action')">
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
                        <input type="button" value="Delete selection" onclick="deleteAll('action_multi_delete','action')" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
