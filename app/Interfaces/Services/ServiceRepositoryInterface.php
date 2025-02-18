<?php
namespace App\Interfaces\Services;

use Illuminate\Support\Facades\Request;

interface ServiceRepositoryInterface
{

    public function index();
    public function store($request);
    public function update($request , $id);
    public function destroy($request);
}

