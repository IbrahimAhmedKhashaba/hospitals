<?php
namespace App\Interfaces\Doctors;

use Illuminate\Support\Facades\Request;

interface DoctorRepositoryInterface
{

    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request , $id);
    public function destroy($request);
    public function update_password($request , $id);
    public function update_status($id);
}

