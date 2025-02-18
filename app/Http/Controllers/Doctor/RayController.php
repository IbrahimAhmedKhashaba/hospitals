<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorDashboard\ConversionRequest;
use App\Interfaces\DoctorDashboard\Rays\RaysRepositoryInterface;

class RayController extends Controller
{

    private $rays;

    public function __construct(RaysRepositoryInterface $rays)
    {
        $this->rays = $rays;
    }

    public function store(ConversionRequest $request)
    {
        //
        return $this->rays->store($request);
    }

    public function update(ConversionRequest $request, string $id)
    {
        //
        return $this->rays->update($request , $id);
    }

    public function destroy(string $id)
    {
        //
        return $this->rays->destroy($id);
    }
}
