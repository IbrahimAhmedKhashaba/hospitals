<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Services\SingleServiceRequest;
use App\Repository\Services\ServiceRepository;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{
    private $services;

    public function __construct(ServiceRepository $services){
        $this->services = $services;
    }
    public function index()
    {
        //
        return $this->services->index();
    }
    public function store(SingleServiceRequest $request)
    {
        //
        return $this->services->store($request);
    }

    public function update(SingleServiceRequest $request, string $id)
    {
        //
        return $this->services->update($request, $id);
    }

    public function destroy(Request $request)
    {
        //
        return $this->services->destroy($request);
    }
}
