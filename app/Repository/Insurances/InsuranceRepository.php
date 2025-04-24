<?php
namespace App\Repository\Insurances;

use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Models\Insurance;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class InsuranceRepository implements InsuranceRepositoryInterface
{
    use UploadImageTrait;
    public function index()
    {
        $insurances = Insurance::with('translations')->get();
        
        return view('Dashboard.Insurances.index' , compact(['insurances']));
    }

    public function create(){
        return view('Dashboard.Insurances.create');
    }

    public function store($request){

        try{
            $Insurance = new Insurance();

            $Insurance->insurance_code = $request->insurance_code;
            $Insurance->discount_percentage = $request->discount_percentage;
            $Insurance->company_rate = $request->company_rate;
            $Insurance->status = 1;
            $Insurance->save();
            $Insurance->name = $request->name;
            $Insurance->notes = $request->notes;
            $Insurance->save();
            session()->flash('add');
            Cache::forget('insurances');
            return redirect()->route('insurances.create');
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){
        $insurance = Insurance::find($id);
        return view('Dashboard.Insurances.edit' , compact(['insurance']));
    }

        public function update($request , $id){

        try {

            $Insurance = Insurance::findOrFail($id);

            $Insurance->insurance_code = $request->insurance_code;
            $Insurance->discount_percentage = $request->discount_percentage;
            $Insurance->company_rate = $request->company_rate;
            $Insurance->status = $request->status ?? 0;
            $Insurance->save();
            $Insurance->name = $request->name;
            $Insurance->notes = $request->notes;
            $Insurance->save();

            DB::commit();
            Cache::forget('insurances');
            session()->flash('edit');
            return redirect()->route('insurances.index');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id){
        try{
            $insurance = Insurance::findOrFail($id);
            $insurance->delete();
            Cache::forget('insurances');
            session()->flash('delete');
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('insurances.index');
    }
}

