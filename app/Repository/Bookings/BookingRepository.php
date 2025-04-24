<?php


namespace App\Repository\Bookings;
use App\Interfaces\Bookings\BookingRepositoryInterface;
use App\Mail\CreatePatient;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class BookingRepository implements BookingRepositoryInterface
{
    public function index()
    {
        $bookings =  Booking::with('doctor.translations')->get();
        return view('Dashboard.Bookings.index',compact('bookings'));
    }

    public function show($id){
        DB::beginTransaction();
        try {
            $booking = Booking::find($id);
            $patient = Patient::firstOrCreate([
                'email' => $booking->email,
            ] , [
                'password' => Hash::make($booking->phone),
                'date_birth' => $booking->date_birth,
                'phone' => $booking->phone,
                'gender' => $booking->gender,
                'blood_group' => $booking->blood_group,
                'name' => $booking->name,
                'address' => $booking->address,
            ]);
            $booking->delete();
            
            $doctor = Doctor::with(['appointments'])->findOrFail($booking->doctor_id);
            if($patient->wasRecentlyCreated){
                Mail::to($booking->email)->send(new CreatePatient($booking->email , $booking->phone , $doctor->appointments));
            } else {
                Mail::to($booking->email)->send(new CreatePatient('' , '' , $doctor->appointments));
            }
            session()->flash('add');
            DB::commit();
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Booking::destroy($id);
        
        session()->flash('delete');
        return redirect()->back();
    }
}
