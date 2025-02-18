<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Insurances\InsuranceRequest;
use App\Repository\Insurances\InsuranceRepository;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    //
    private $insurances;

    public function __construct(InsuranceRepository $insurances){
        $this->insurances = $insurances;
    }

    public function index()
    {
        //
        return $this->insurances->index();
    }

    public function create()
    {
        //
        return $this->insurances->create();
    }

    public function store(InsuranceRequest $request)
    {
        //
        return $this->insurances->store($request);
    }

    public function edit(string $id)
    {
        //
        return $this->insurances->edit($id);
    }

    public function update(InsuranceRequest $request, string $id)
    {
        //
        return $this->insurances->update($request , $id);
    }

    public function destroy($id)
    {
        return $this->insurances->destroy($id);
    }
}
