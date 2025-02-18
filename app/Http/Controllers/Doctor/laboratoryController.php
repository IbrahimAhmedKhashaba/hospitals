<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorDashboard\ConversionRequest;
use App\Interfaces\DoctorDashboard\Laboratories\LaboratoryRepositoryInterface;
use Illuminate\Http\Request;

class laboratoryController extends Controller
{
    private $Laboratories;

    public function __construct(LaboratoryRepositoryInterface $Laboratories)
    {
        $this->Laboratories = $Laboratories;
    }
    public function store(ConversionRequest $request)
    {
        //
        return $this->Laboratories->store($request);
    }

    public function update(ConversionRequest $request, string $id)
    {
        //
        return $this->Laboratories->update($request , $id);
    }

    public function destroy(string $id)
    {
        //
        return $this->Laboratories->destroy($id);
    }

    public function showLaboratory($id){
        return $this->Laboratories->showLaboratory($id);
    }
}
