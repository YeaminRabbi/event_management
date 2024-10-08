<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntegrationController extends Controller
{
    public function index(){
        
        $integration = Auth::user()->integration;

        return view('adminpanel.integration.index', compact('integration'));
    }    

    public function destroy(Request $request, Integration $integration){
        $integration->delete();
        return back();
    }
}
