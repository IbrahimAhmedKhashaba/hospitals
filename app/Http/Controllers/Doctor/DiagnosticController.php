<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorDashboard\DiagnosisRequest;
use App\Http\Requests\DoctorDashboard\ReviewRequest;
use App\Interfaces\DoctorDashboard\Diagnosis\DiagnosisRepositoryInterface;


class DiagnosticController extends Controller
{
    private $diagnosis;

    public function __construct(DiagnosisRepositoryInterface $diagnosis)
    {
        $this->diagnosis = $diagnosis;
    }

    public function store(DiagnosisRequest $request)
    {
        //
        return $this->diagnosis->store($request);
    }

    public function show(string $id)
    {
        //
        return $this->diagnosis->show($id);
    }

    public function destroy(string $id)
    {
        //
    }

    public function addReview(ReviewRequest $request)

    {
        //
        return $this->diagnosis->addReview($request);
    }
}
