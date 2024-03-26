<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\BusinessHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('user')->get();
        $businessHours = BusinessHours::orderBy('daysOfWeek')->get();

        $sunday = BusinessHours::where('daysOfWeek', 0)->get();
        $monday = BusinessHours::where('daysOfWeek', 1)->get();
        $thursday = BusinessHours::where('daysOfWeek', 2)->get();
        $wednesday = BusinessHours::where('daysOfWeek', 3)->get();
        $tuesday = BusinessHours::where('daysOfWeek', 4)->get();
        $friday = BusinessHours::where('daysOfWeek', 5)->get();
        $saturday = BusinessHours::where('daysOfWeek', 6)->get();

        return Inertia::render('Calendar', [
            'appointments' => $appointments,
            'business_hours' => $businessHours,
            'sunday' => $sunday,
            'monday' => $monday,
            'thursday' => $thursday,
            'wednesday' => $wednesday,
            'tuesday' => $tuesday,
            'friday' => $friday,
            'saturday' => $saturday,
        ]);
    }


}
