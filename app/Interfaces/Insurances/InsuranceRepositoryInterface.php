<?php
namespace App\Interfaces\Insurances;

use Illuminate\Support\Facades\Request;

interface InsuranceRepositoryInterface
{

    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request , $id);
    public function destroy($request);
}

