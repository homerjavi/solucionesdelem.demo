<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Chat;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ServiceController extends Controller
{
    public function index() :View
    {
        // If we are logged in, it will only show us the services not created by us
        $services = auth()->user()
            ? Service::notCreatedByAuthenticatedUser()->get() 
            : Service::all();

        $servicesResource = ServiceResource::collection( $services )->resolve();

        return view( 'services.index', [
            'services' => $servicesResource
        ] );
    }

    public function userServices() :View
    {
        $services = ServiceResource::collection( Service::createdByAuthenticatedUser()->get() )->resolve();

        return view( 'services.index', compact( 'services' ) );
    }

    public function create() :View
    {
        return view( 'services.form' );
    }

    public function store( ServiceRequest $request ) :Redirector
    {
        try {
            Service::create( $request->validated() );
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect( 'my-services' );
    }
}
