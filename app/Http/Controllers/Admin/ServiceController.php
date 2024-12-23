<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function store(ServiceRequest $request)
    {

        try {

            $service = new Service();
            $service->short_description = $request->servicedescription;
            $service->service_icon = $request->serviceicon;
            $service->service_title = $request->servicetitle;
            $service->service_description = $request->longdescription;
            $service->featur_icon = $request->featureicon;
            $service->feature_title = $request->featuretitle;
            $service->feature_description = $request->featuredescription;
            $service->save();
            return response()->json(['status' => 'success', 'message' => 'Service successfully added'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'message' => 'Service not added', 'error_message' => $th->getMessage()], 500);
        }
    }

    public function index()
    {

        $service = Service::orderBy('id', 'DESC')->get();

        return response()->json(['data' => $service], 200);
    }

    public function edit($id)
    {
        try {
            $service = Service::find($id);

            if (!$service) {
                return response()->json(['message' => 'Service is not found'], 404);
            }
            return response()->json(['data' => $service], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        return "dsddsds";
    }
}
