
<head>
    <style>
        table *{
            /* font-weight: 100; */
            border-collapse: collapse;
        }
        table.main, table.main {
            border: 5px solid black;
        }
        table.head1 {
            background-color: rgb(240, 161, 25);
            width: 100%;
        }
        table.head2 {
            background-color: rgb(25, 165, 240);
            width: 100%;
        }
        table.body1 {
            background-color: rgb(240, 25, 175);
            width: 100%;
        }
        table.head2 tr td {
            border: 1px solid black;
        }
        table.body1 tr td {
            border: 1px solid black;
        }


    </style>
</head>

<table class="main">
    <tbody>
        <tr>
            <td>
                <table class="head1">
                    <thead>
                        <tr>
                            <th colspan="1"><img src="{{ url('images/logo.png') }}" alt=""></th>
                            <th colspan="9">SCHEDA CONTROLLO PROCESSO</th>
                            <th colspan="2">Mod rev</th>
                        </tr>
                    </thead>
                <table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="head2">
                    <tbody>
                        <tr>
                            <td>Nome prodotto:</td>
                            <td>No. Ordine:</td>
                            <td>Lotto Materiale 1:</td>
                            <td>Lotto Materiale 2:</td>
                            <td>Lotto Materiale 3:</td>
                            <td>Lotto Materiale 4:</td>
                        </tr>
                        <tr>
                            <td>{{ $production->desc_article }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Codice prodotto:</td>
                            <td>No. Pressa:</td>
                            <td>No. Ausilisare 1:</td>
                            <td>No. Ausilisare 2:</td>
                            <td>No. Ausilisare 3:</td>
                            <td>No. Ausilisare 4:</td>
                        </tr>
                        <tr>
                            <td>{{ $production->code_article }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="body1">
                    <thead>
                        <tr>
                            <th>DATA</th>
                            <th>ORA</th>
                            <th><strong>OPERATORE</strong> <i>CQ/CT/PRODUZIONE</i></th>
                            <th><strong>OPERATORE</strong> BORDO MCCHINA</th>
                            <th><strong>CODICE</strong> OPERAZIONE</th>
                            <th><strong>CODICE</strong> PRODUZIONE/ QUALITÀ</th>
                            <th><strong>CARICO MATERIALE</strong></th>
                            <th><strong>CONTAPEZZI PROGRESSIVO</strong></th>
                            <th><strong>PRODUZIONE TURNO</strong></th>
                            <th><strong>NOTE</strong></th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($actions as $action)
                        <tr>
                            <td>{{ $action->id }}</td>
                            <td>{{ $action->name }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>NOTE</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </th>
        </tr>
    </tbody>
</table>

{{--
@section('title','Export')

@section('content')
    <script type="text/javascript">
        window.onload = () =>
        {
            $(".main-sidebar").niceScroll();
        }
    </script>
    @if (Session::has('msg'))
    <script>
            var msg = "<php echo Session::get('msg'); ?>"
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

<p>$production</p>
<section class="section">
    <div class="section-header">
        <h1>{{ __('Machine #').$production->machine_id }}</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <a href="/home" class="btn btn-primary"><i class="fas fa-arrow-left "></i></a>
                &nbsp;
                <a href="/home" class="btn btn-primary"><i class="fas fa-home "></i></a>
            </div>
        </div>
    </div>

    <div class="row mt-sm-4">
        @if( $production != null && $production->status == 'C' )
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card profile-widget">
                <div class="profile-widget-header section-header">
                    <div class="col-lg-6">
                        <h3>Current Order Details</h3>
                    </div>
                    <div class="col-lg-3">
                        <div class="row">
                            <form id="machine_prod" action="{{ url('production_machine') }}" method="POST">
                                @csrf
                                <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                                <a href="" onclick="event.preventDefault(); document.getElementById('machine_prod').submit();" class="btn btn-primary float-right">{{__('All orders')}}</a>
                            </form>
                        </div>

                        <div class="row">
                            <form id="create_prod" action="{{ url('operation/create_production') }}" method="POST">
                                @csrf
                                <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                                <a href="" onclick="event.preventDefault(); document.getElementById('create_prod').submit();" class="btn btn-primary float-right">{{__('Create new order')}}</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{__('Production #')}} : {{ $production->id }}<br>
                        {{__('Order id')}} : {{ $production->order_id }}<br>
                        {{__('Article code')}} : {{ $production->code_article }}<br>
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
        </div> -}}
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
                                <form id="create_prod" action="{{ url('operation/create_production') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                                    <a href="" onclick="event.preventDefault(); document.getElementById('create_prod').submit();" class="btn btn-primary float-right">{{__('Create new order')}}</a>
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

    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="actions-tab" data-toggle="tab" href="#actions" role="tab"aria-controls="actions" aria-selected="true">{{__('Actions')}}({{count($actions)}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="scartos-tab" data-toggle="tab" href="#scartos" role="tab" aria-controls="scartos" aria-selected="false">{{__('Scartos')}}({{count($scartos)}})</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="section-action tab-pane fade show active" id="actions" role="tabpanel" aria-labelledby="actions-tab">
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
                            <th>#</th>
                            <th>{{__('Action')}}</th>
                            <th>{{__('User')}}</th>
                            <th>{{__('Created at')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Material')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actions as $action)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $action->name }}</td>
                                <td>{{ $action->fullname }}</td>
                                <td>{{ date('H:i:s d/m/Y', strtotime($action->created_at)) }}</td>
                                <td>{{ $action->quantity }}</td>
                                <td>{{ $action->material }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="section-scarto tab-pane fade" id="scartos" role="tabpanel" aria-labelledby="scartos-tab">
        <h2 class="section-title">{{__('Scarto')}}</h2>
        <p class="section-lead">{{__('Scarto within production #').$production->id}}</p>
        <div class="card">
            <div class="card-header">
                <div class="w-100">
                    <form id="add_scar" action="operation/create_scarto" method="POST">
                        @csrf
                        <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                        <input type="hidden" name='production_id' value="{{ $production->id }}">
                        <a href="" onclick="event.preventDefault(); document.getElementById('add_scar').submit();" class="btn btn-primary float-right">{{__('Add scarto')}}</a>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('User')}}</th>
                            <th>{{__('Scarto')}}</th>
                            <th>{{__('Created at')}}</th>
                            <th>{{__('Motif')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scartos as $scarto)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $scarto->fullname }}</td>
                                <td>{{ $scarto->scarto }}</td>
                                <td>{{ date('H:i:s d/m/Y', strtotime($scarto->created_at)) }}</td>
                                <td>{{ $scarto->scarto_pr }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
</section>
@endsection --}}
