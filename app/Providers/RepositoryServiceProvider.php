<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\Bookings\BookingRepositoryInterface;
use App\Interfaces\DoctorDashboard\Diagnosis\DiagnosisRepositoryInterface;
use App\Interfaces\DoctorDashboard\Invoices\InvoiceRepositoryInterface;
use App\Interfaces\DoctorDashboard\Laboratories\LaboratoryRepositoryInterface;
use App\Interfaces\DoctorDashboard\PatientDetails\PatientDetailsRepositoryInterface;
use App\Interfaces\RayEmployees\RayEmployeeRepositoryInterface;
use App\Interfaces\DoctorDashboard\Rays\RaysRepositoryInterface;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Interfaces\LaboratoryEmployeeDashboard\Invoices\InvoiceRepositoryInterface as LaboratoryEmployeeDashboardInvoicesInvoiceRepositoryInterface;
use App\Interfaces\LaboratoryEmployees\LaboratoryEmployeeRepositoryInterface;
use App\Interfaces\PatientDashboard\PatientDashboardRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Interfaces\RayEmployeeDashboard\Invoices\InvoiceRepositoryInterface as InvoicesInvoiceRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Repository\Bookings\BookingRepository;
use App\Repository\DoctorDashboard\Diagnosis\DiagnosisRepository;
use App\Repository\DoctorDashboard\Invoices\InvoiceRepository;
use App\Repository\DoctorDashboard\Laboratories\LaboratoryRepository;
use App\Repository\LaboratoryEmployees\LaboratoryEmployeeRepository;
use App\Repository\RayEmployees\RayEmployeeRepository;
use App\Repository\DoctorDashboard\Rays\RaysRepository;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Finance\PaymentRepository;
use App\Repository\Finance\ReceiptRepository;
use App\Repository\Insurances\InsuranceRepository;
use App\Repository\LaboratoryEmployeeDashboard\Invoices\InvoiceRepository as LaboratoryEmployeeDashboardInvoicesInvoiceRepository;
use App\Repository\PatientDashboard\PatientDashboardRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\RayEmployeeDashboard\Invoices\InvoiceRepository as InvoicesInvoiceRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Services\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        // admins
        $this->app->bind(SectionRepositoryInterface::class , SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class , DoctorRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class , ServiceRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class , InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class , AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class , PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class , ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class , PaymentRepository::class);
        $this->app->bind(RayEmployeeRepositoryInterface::class , RayEmployeeRepository::class);
        $this->app->bind(LaboratoryEmployeeRepositoryInterface::class , LaboratoryEmployeeRepository::class);
        $this->app->bind(BookingRepositoryInterface::class , BookingRepository::class);

        //doctors
        $this->app->bind(InvoiceRepositoryInterface::class , InvoiceRepository::class);
        $this->app->bind(DiagnosisRepositoryInterface::class , DiagnosisRepository::class);
        $this->app->bind(RaysRepositoryInterface::class , RaysRepository::class);
        $this->app->bind(PatientDetailsRepositoryInterface::class , PatientRepository::class);
        $this->app->bind(LaboratoryRepositoryInterface::class , LaboratoryRepository::class);

        //ray employees
        $this->app->bind(InvoicesInvoiceRepositoryInterface::class , InvoicesInvoiceRepository::class);

        //Laboratory employees
        $this->app->bind(LaboratoryEmployeeDashboardInvoicesInvoiceRepositoryInterface::class , LaboratoryEmployeeDashboardInvoicesInvoiceRepository::class);

        //Patients
        $this->app->bind(PatientDashboardRepositoryInterface::class , PatientDashboardRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
