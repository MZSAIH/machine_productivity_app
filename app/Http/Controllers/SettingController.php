<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Machine;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general_setting = GeneralSetting::first();
        return view('admin.setting',compact('general_setting'));
    }


    public function update_general_setting(Request $request)
    {
        $data = $request->all();
        $id = GeneralSetting::first();
        if ($file = $request->hasfile('company_white_logo'))
        {
            $request->validate(
            ['company_white_logo' => 'max:1000'],
            [
                'company_white_logo.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            (new CustomController)->deleteImage(DB::table('general_setting')->where('id', $id->id)->value('company_white_logo'));
            $data['company_white_logo'] = (new CustomController)->uploadImage($request->company_white_logo);
        }
        if ($file = $request->hasfile('company_black_logo'))
        {
            $request->validate(
            ['company_black_logo' => 'max:1000'],
            [
                'company_black_logo.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            (new CustomController)->deleteImage(DB::table('general_setting')->where('id', $id->id)->value('company_black_logo'));
            $data['company_black_logo'] = (new CustomController)->uploadImage($request->company_black_logo);
        }
        if ($file = $request->hasfile('favicon'))
        {
            $request->validate(
            ['favicon' => 'max:1000'],
            [
                'favicon.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            (new CustomController)->deleteImage(DB::table('general_setting')->where('id', $id->id)->value('favicon'));
            $data['favicon'] = (new CustomController)->uploadImage($request->favicon);
        }

        $id->update($data);
        return redirect('/setting')->with('msg','setting changed successfully..!!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit(Machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Machine $machine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Machine $machine)
    {
        //
    }
}
