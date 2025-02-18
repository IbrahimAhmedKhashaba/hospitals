<?php

namespace App\Repository\RayEmployees;

use App\Interfaces\RayEmployees\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{
    public function index()
    {
        //
        $ray_employees = Cache::remember('ray_employees' , 3600 , function(){
            return RayEmployee::all();
        });
        return view('Dashboard.ray_employee.index' , compact('ray_employees'));
    }


    public function store($request)
    {
        try {

            $ray_employee = new RayEmployee();
            $ray_employee->name = $request->name;
            $ray_employee->email = $request->email;
            $ray_employee->password = Hash::make($request->password);
            $ray_employee->save();
            Cache::forget('ray_employees');
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

        $ray_employee = RayEmployee::find($id);
        $ray_employee->update($input);
        Cache::forget('ray_employees');
        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            RayEmployee::destroy($id);
            Cache::forget('ray_employees');
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
