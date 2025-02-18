<?php

namespace App\Interfaces\DoctorDashboard\Laboratories;

interface LaboratoryRepositoryInterface
{
    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function showLaboratory($id);

}
