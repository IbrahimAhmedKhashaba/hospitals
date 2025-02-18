<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Doctors\StoreDoctorRequest;
use App\Http\Requests\Dashboard\Doctors\UpdatePasswordRequest;
use App\Repository\Doctors\DoctorRepository;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $doctors;

    public function __construct(DoctorRepository $doctors){
        $this->doctors = $doctors;
    }

    public function index()
    {
        //
        return $this->doctors->index();
    }

    public function create()
    {
        //
        return $this->doctors->create();
    }

    public function store(StoreDoctorRequest $request)
    {
        //
        return $this->doctors->store($request);
    }

    public function edit(string $id)
    {
        //
        return $this->doctors->edit($id);
    }

    public function update(StoreDoctorRequest $request, string $id)
    {
        //
        return $this->doctors->update($request , $id);
    }

    public function destroy(string $id , Request $request)
    {
        return $this->doctors->destroy($request);
    }

    public function update_password(UpdatePasswordRequest $request , $id){
        return $this->doctors->update_password($request , $id);
    }

    public function update_status($id){
        return $this->doctors->update_status($id);
    }
}
