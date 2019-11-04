<?php

namespace App\Http\Controllers\Front;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        return view('app.doctors.index');
    }

    public function create()
    {
        return view('app.doctors.create');
    }


    public function edit(Doctor $doctor)
    {
      return view('app.doctors.edit', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return $doctor;
    }
}
