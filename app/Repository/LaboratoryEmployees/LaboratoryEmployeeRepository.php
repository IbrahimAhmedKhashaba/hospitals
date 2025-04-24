<?php

namespace App\Repository\LaboratoryEmployees;

use App\Interfaces\LaboratoryEmployees\LaboratoryEmployeeRepositoryInterface;
use App\Models\LaboratoryEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeRepository implements LaboratoryEmployeeRepositoryInterface
{

    public function index()
    {
        $laboratory_employees = LaboratoryEmployee::all();
        
        return view('Dashboard.LaboratoryEmployees.index',compact('laboratory_employees'));
    }

    public function store($request)
    {
        try {

            $laboratory_employees = new LaboratoryEmployee();
            $laboratory_employees->name = $request->name;
            $laboratory_employees->email = $request->email;
            $laboratory_employees->password = Hash::make($request->password);
            $laboratory_employees->save();
            session()->flash('add');
            return back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, ['password']);
        }

        $laboratory_employees = LaboratoryEmployee::find($id);
        $laboratory_employees->update($input);
        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            LaboratoryEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
