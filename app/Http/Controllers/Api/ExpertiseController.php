<?php

namespace App\Http\Controllers\Api;

use App\Expertise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpertiseController extends Controller
{
    public function index()
    {
        return Expertise::all();
    }
}
