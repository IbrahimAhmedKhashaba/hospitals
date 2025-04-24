<?php
namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadImageTrait;
    public function index()
    {

        $doctors = Doctor::with(['translations', 'section.translations', 'image', 'appointments.translations'])->get();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }

    public function create(){
        $sections = Section::with('translations')->get();
        
        $appointments = Appointment::with('translations')->get();
        
        return view('Dashboard.Doctors.add' , compact(['sections' , 'appointments']));
    }

    public function store($request){

        DB::beginTransaction();

        try{
            $doctor = new Doctor();

            $doctor->email = $request->email;
            $doctor->password = Hash::make(value: $request->password);
            $doctor->phone = $request->phone;
            $doctor->section_id = $request->section_id;
            $doctor->status = 1;
            $doctor->save();

            $doctor->name = $request->name;
            $doctor->save();

            $doctor->appointments()->sync($request->appointments);



            $this->verifyAndStoreImage($request , 'photo' , 'doctors' , 'upload_image' , $doctor->id , 'App\Models\Doctor');

            DB::commit();
            session()->flash('add');
            return redirect()->route('doctors.create');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){
        $sections = Section::with('translations')->get();
        
        $appointments = Appointment::with('translations')->get();
        
        $doctor = Doctor::with(['translations' , 'section.translations' , 'image' , 'appointments.translations'])->findOrFail($id);
        return view('Dashboard.Doctors.edit' , compact(['doctor' , 'sections' , 'appointments']));
    }

        public function update($request , $id){
            DB::beginTransaction();

        try {

            $doctor = Doctor::with('image')->findOrFail($id);

            if ($request->has('photo')){
                if ($doctor->image){
                    $old_img = $doctor->image->filename;
                    $this->deleteAttachment('upload_image','doctors/'.$old_img,$doctor->image->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$id,'App\Models\Doctor');
            }

            $doctor->update([
                'email' => $request->email,
                'section_id' => $request->section_id,
                'phone' => $request->phone,
                'name' => $request->name,
            ]);
            // update pivot tABLE
            $doctor->appointments()->sync($request->appointments);

            DB::commit();
            session()->flash('edit');
            return redirect()->back();

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        if($request->page_id ==1 ){
            if($request->filename){
                $this->deleteAttachment('upload_image' , 'doctors/'.$request->filename , $request->id);
            }

            Doctor::destroy($request->id);
        } else{

            $delete_select_id = explode(',',$request->delete_select_id);

            foreach($delete_select_id as $ids_doctors){
                $doctor = Doctor::findOrFail($ids_doctors);
                if($doctor->image){
                    $this->deleteAttachment('upload_image' , 'doctors/'.$doctor->image->file_name , $doctor->image->id);
                }

                Doctor::destroy($delete_select_id);
            }
        }
        session()->flash('delete');
        return redirect()->route('doctors.index');
    }

    public function update_password($request , $id){
        try{
            $doctor = Doctor::findOrFail($id);
            $doctor->update([
                'password' => Hash::make($request->password),
            ]);
            session()->flash('edit');
            return redirect()->route('doctors.index');
        } catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status($id){
        try{
            $doctor = Doctor::findOrFail($id);
            $doctor->status == 1 ? $doctor->status=2: $doctor->status=1;
            $doctor->save();
            return redirect()->route('doctors.index');
        } catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

