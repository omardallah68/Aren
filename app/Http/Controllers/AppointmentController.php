<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $appointment = new Appointment([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        $appointment->save();

        $user = User::find($appointment->user_id);
        $appointment->setAttribute('user', $user);

        return response()->json($appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $appointment = Appointment::where('id',$request->get('id'))->first();
        $start = Carbon::parse($request->input('start'))->addHours(2)->format('Y-m-d H:i:s');
        $end = Carbon::parse($request->input('end'))->addHours(2)->format('Y-m-d H:i:s');
        $appointment->update([
            'start' => $start,
            'end' => $end
        ]);

        return response()->json([
            'message'=>"Successfully changed! Now is from $start to $end",
            'bannerStyle'=>'success'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
