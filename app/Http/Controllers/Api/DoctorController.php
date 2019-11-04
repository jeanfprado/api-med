<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Requests\DoctorRequest as Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        return Doctor::ofSearch(\Request::get('params'))->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (count($data['expertises']) >= 2 ) {

            $doctor = Doctor::create($data);
            $doctor->expertises()->sync($data['expertises']);
            return $doctor;
        }


    }

    public function show(Doctor $doctor)
    {
        return $doctor;
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->all();
        if (count($data['expertises']) >= 2 ) {

            $doctor->update($data);

            $doctor->expertises()->sync($data['expertises']);

        }
        return $doctor;
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return $doctor;
    }
}
