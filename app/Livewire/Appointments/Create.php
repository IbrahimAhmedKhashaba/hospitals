<?php

namespace App\Livewire\Appointments;

use App\Jobs\AddBookingJob;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Section;
use App\Notifications\AddBooking;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $address;
    public $gender;
    public $blood_group;
    public $date_birth;
    public $phone;
    public $notes;
    public $message = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric',
        'gender' => 'required|in:1,2',
        'date_birth' => 'required|date',
        'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
        'address' => 'required|string|max:255',
        'doctor' => 'required|exists:doctors,id',
    ];

    public function mount(){
        $this->sections = Cache::remember('sections' , 3600 , function(){
            return Section::with(['translations' , 'doctors.translations' , 'invoices'])->get();
        });
        $this->doctors = collect();
    }

    public function render()
    {
        $sections = Cache::remember('sections' , 3600 , function(){
            return Section::with(['translations' , 'doctors.translations' , 'invoices'])->get();
        });
        return view('livewire.appointments.create',
            [
                'sections' => $sections
            ]);
    }

    public function getDoctors(){

       $this->doctors = Doctor::where('section_id',$this->section)->get();
    }

    public function store(){
        $this->validate();
        $appointments = new Booking();
        $appointments->name = $this->name;
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->gender = $this->gender;
        $appointments->date_birth = $this->date_birth;
        $appointments->blood_group = $this->blood_group;
        $appointments->address = $this->address;
        $appointments->doctor_id = $this->doctor;
        $appointments->save();
        Cache::forget('bookings');
        $admins = Admin::get();
        AddBookingJob::dispatch($admins);
        $this->message = true;


    }


}
