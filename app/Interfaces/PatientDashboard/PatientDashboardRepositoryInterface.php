<?php


namespace App\Interfaces\PatientDashboard;


interface PatientDashboardRepositoryInterface
{
    public function invoices();
    public function laboratories();
    public function viewLaboratory($id);
    public function rays();
    public function viewRay($id);
    public function payments();

}
