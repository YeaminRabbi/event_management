<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntegrationController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'role_or_permission:integration-module',
        ];
    }

    public function index(){
        
        $integration = Auth::user()->integration;

        return view('adminpanel.integration.index', compact('integration'));
    }    

    public function destroy(Request $request, Integration $integration){
        $integration->delete();
        return back();
    }
}
