@extends('layouts.app',['activePage' => 'setting'])

@section('title','General settings')

@section('content')

<section class="section">
    @if (Session::has('msg'))
        <script>
            var msg = "<?php echo Session::get('msg'); ?>"
                $(window).on('load', function()
                {
                    iziToast.success(
                    {
                        message: msg,
                        position: 'topRight'
                    });
                });
        </script>
    @endif

    <div class="section-header">
        <h1>{{__('réglages généraux')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('/setting') }}">{{__('Settings')}}</a></div>
            <div class="breadcrumb-item">{{__('General settings')}}</div>
        </div>
    </div>
    <div class="section-body">
        @if ($errors->any())
        <div class="alert alert-primary alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                @foreach ($errors->all() as $item)
                    {{ $item }}
                @endforeach
            </div>
        </div>
        @endif
        <h2 class="section-title">{{__('réglages généraux')}}</h2>
        <p class="section-lead">{{__('Personnaliser vos paramètres')}}</p>
        <div class="card p-2">
            <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form action="{{ url('/update_general_setting') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h5 class="mt-3">{{__('réglages généraux')}}</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label for="Promo code name">{{__('logo blanc')}}</label>
                                    <div class="logoContainer">
                                        <img id="image" src="{{ $general_setting->whitelogo }}" width="180" height="150">
                                    </div>
                                    <div class="fileContainer sprite">
                                        <span>{{__('Image')}}</span>
                                        <input type="file" name="company_white_logo" value="Choose File" id="previewImage" data-id="edit" accept=".png, .jpg, .jpeg, .svg">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label for="Image">{{__('logo noir')}}</label>
                                    <div class="logoContainer">
                                        <img id="licence_doc" src="{{ $general_setting->blacklogo }}"  width="180" height="150">
                                    </div>
                                    <div class="fileContainer">
                                        <span>{{__('Image')}}</span>
                                        <input type="file" name="company_black_logo" value="Choose File" id="previewlicence_doc" data-id="edit" accept=".png, .jpg, .jpeg, .svg">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="Image">{{__('Favicon')}}</label>
                                    <div class="logoContainer">
                                        <img id="imgFavicon" src="{{ url('images/upload/'.$general_setting->favicon) }}"  width="180" height="150">
                                    </div>
                                    <div class="fileContainer">
                                        <span>{{__('Image')}}</span>
                                        <input type="file" name="favicon" value="Choose File" data-id="edit" id="previewFaviconImg" accept=".png, .jpg, .jpeg, .svg">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name">{{__('Nom du société')}}</label>
                                    <input type="text" name="business_name" class="form-control" value="{{ $general_setting->business_name }}" placeholder="{{__('Business Name')}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact_person_name">{{__('nom de contacte')}}</label>
                                    <input type="text" name="contact_person_name" class="form-control"
                                        value="{{ $general_setting->contact_person_name }}"
                                        placeholder="{{__('Contact Person Name')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact">{{__('Contacte')}}</label>
                                    <input type="text" name="contact" class="form-control"
                                        value="{{ $general_setting->contact }}" placeholder="{{__('Contact Number')}}">
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="business_address">{{__('adresse professionelle')}}</label>
                                    <input type="text" name="business_address" class="form-control"
                                        value="{{ $general_setting->business_address }}"
                                        placeholder="{{__('Business Address')}}">
                                </div>
                            </div>
                            <!--
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="tax_id">{{__('Tax Id number')}}</label>
                                    <input type="text" name="tax_id" value="{{ $general_setting->tax_id }}"
                                        placeholder="{{__('Tax Id Number')}}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="timezone">{{__('timezone')}}</label>
                                    <select class="form-control select2" name="timezone">
                                        foreach ($timezones as $timezone)
                                        <option value="{ $timezone->TimeZone }}"
                                            { $general_setting->timezone == $timezone->TimeZone ? 'selected' : '' }}>
                                            { $timezone->UTC_DST_offset }}&nbsp;&nbsp;{ $timezone->TimeZone }}</option>
                                        endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="tax_id">{{__('Currency')}}</label>
                                    <select class="form-control select2 @error('currency') is-invalid @enderror"
                                        data-toggle="select" title="select currency" name="currency"
                                        data-placeholder="Select A Currency" id="currency">
                                        foreach ($currencies as $currency)
                                        <option value="{$currency->code}}"
                                            { $general_setting->currency == $currency->code ? 'selected' : '' }}>
                                            {$currency->country}}&nbsp;&nbsp;({$currency->currency}})&nbsp;&nbsp;({$currency->code}})
                                        </option>
                                        endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tax_id">{{__('Help line number')}}</label>
                                    <input type="text" name="help_line_no" value="{{ $general_setting->help_line_no }}"
                                        placeholder="{{__('Help Line Number')}}" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label for="google key">{{__('Settlement Days')}}</label>
                                    <input type="number" name="settlement_days" class="form-control" value="{{$general_setting->settlement_days}}">
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label for="google key">{{__('Google map key')}}</label>
                                    <input type="text" name="map_key" class="form-control" value="{{$general_setting->map_key}}" style="text-transform: none;">
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label for="">{{__('radius (How many kms of vendor is shown in the app)')}}</label>
                                    <input type="number" name="radius" class="form-control"
                                        value="{{$general_setting->radius}}">
                                </div>
                            </div>

                            <h5 class="mt-5">{{__('bussiness hours time')}}</h5>
                            <hr>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="start time">{{__('start time')}}</label>
                                    <input type="time" class="form-control" value="{{ $general_setting->start_time }}" name="start_time">
                                </div>
                                <div class="col-md-6">
                                    <label for="end time">{{__('end time')}}</label>
                                    <input type="time" class="form-control" value="{{ $general_setting->end_time }}" name="end_time">
                                </div>
                            </div>

                            <h5 class="mt-5">{{__('bussiness Availability')}}</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="max_user">{{__('Status')}}</label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="business_availability"
                                            {{ $general_setting->business_availability == 1 ? 'checked' : '' }}>
                                        <div class="slider"></div>
                                    </label>
                                </div>
                                <div
                                    class="col-md-6 business_avai_msg {{ $general_setting->business_availability == 1 ? 'hide' : '' }}">
                                    <label for="message">{{__('Message')}}</label>
                                    <textarea name="message" class="form-control">{{ $general_setting->message }}</textarea>
                                </div>
                            </div>

                            <h5 class="mt-5">{{__('Tax')}}</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="max_user">{{__('All items price included in tax')}}</label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="isItemTax"
                                            {{ $general_setting->isItemTax == 1 ? 'checked' : '' }}>
                                        <div class="slider"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 {{ $general_setting->isItemTax == 1 ? 'hide' : '' }} txtItemTax">
                                    <label for="gstin">{{__('GSTIN(%)')}}</label>
                                    <input type="text" name="item_tax" value="{{ $general_setting->item_tax }}" class="form-control">
                                </div>
                            </div>

                            <h5 class="mt-5">{{__('Terminology')}}</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">{{__('tax type')}}</label>
                                    <input type="text" name="tax_type" class="form-control"
                                        value="{{$general_setting->tax_type}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">{{__('vendor name')}}</label>
                                    <input type="text" name="vendor_name" value="{{$general_setting->vendor_name}}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">{{__('driver name')}}</label>
                                    <input type="text" name="driver_name" value="{{$general_setting->driver_name}}"
                                        class="form-control">
                                </div>
                            </div>

                            <h5 class="mt-5">{{__('Other')}}</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="max_user">{{__('Takeaway feature')}}</label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="isPickup"
                                            {{ $general_setting->isPickup == 1 ? 'checked' : '' }}>
                                        <div class="slider"></div>
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <label for="isSameDayDelivery">{{__('same day delivery')}}</label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="isSameDayDelivery"
                                            {{ $general_setting->isSameDayDelivery == 1 ? 'checked' : '' }}>
                                        <div class="slider"></div>
                                    </label>
                                </div>
                            </div>
-->
                            <h5 class="mt-5">{{__('Apparences')}}</h5>
                            <hr>
                            <div class="form-group">
                                <label>{{__('La couleur du Site')}}</label>
                                <input id="cp1" name="site_color" type="text" class="form-control"
                                    value="{{ $general_setting->site_color }}" />
                            </div>

                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
