@extends('layouts.app',['activePage' => 'home'])

@section('title','Tableau de bord')

@section('content')
    <script type="text/javascript">
        window.onload = () =>
        {
            $(".main-sidebar").niceScroll();
        }
    </script>
<section class="section">
    <div class="section-header">
        <h1>{{__('Dashboard')}}</h1>
    </div>
    <div class="section-body stats-section">
        <!-- Section insights -->
        {{-- <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card p-3">
                    <form action="{{ url('/home') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12">
                                <input type="text" name="date_range" class="form-control" value=''>
                            </div>


                            <div class="col-md-3 col-lg-3 col-6">
                                <input type="submit" value="{{__('Valider')}}" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="row">


            @foreach ($machines as $machine)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 machine">
                        <form id="mach{{ $machine->id }}" action="{{ url('operation') }}" method="GET">
                        @csrf
                        <input type="hidden" name='machine_id' value="{{ $machine->id }}">
                    </form>
                    @if(Auth::user()->load('roles')->roles->contains('title', 'operator'))
                        <a href="" onclick="event.preventDefault(); document.getElementById('mach{{ $machine->id }}').submit();">
                    @endif
                        <div class="card card-primary rounded-lg hs_stats bg-gradient">
                            <span @class([
                                'machine_finished' => $machine->status == 'F',
                                'machine_paused' => $machine->status == 'P',
                                'machine_operating' => $machine->status == 'C',
                                'machine_error' => $machine->status == 'E',
                                'machine_preparing' => $machine->status == 'R'
                            ])>&nbsp</span>
                            <div class="card-header">
                                <h5>{{__("Machine #").$machine->name}}</h5>

                            </div>

                            <div class="card-body stats">
                                @if($machine->status == 'C' || $machine->status == 'P')
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-pallet text-info"></i>
                                    </div>
                                    <div class="col">
                                        {{-- <canvas id="progressChart{{ $machine->id }}" width="80" height="80"></canvas> --}}

                                        <div class="row"><span class="right">{{ $machine->prod->production_lotto }} / {{ $machine->prod->objectif }}</span></div>
                                        {{-- <div class="row"><span class="right">{{ $machine->prod->objectif }}</span></div> --}}
                                    </div>
                                </div>
                                @endif
                                {{-- @if($machine->status == 'E') --}}
                                    <div class="row">
                                        <p>{{ $latest_action->name }}</p>
                                    </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    @if(Auth::user()->load('roles')->roles->contains('title', 'operator'))
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="hs_height50"></div>
        <!-- Section charts -->

    </div>
</section>
@endsection

