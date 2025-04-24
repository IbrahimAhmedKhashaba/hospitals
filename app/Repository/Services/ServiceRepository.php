<?php
namespace App\Repository\Services;

use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Models\Service;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    use UploadImageTrait;
    public function index()
    {
        $services = Cache::remember('services' , 3600 , function(){
            return Service::with('translations')->get();
        });
        return view('Dashboard.Services.Single Service.index' , compact('services'));
    }


    public function store($request){

        try{
            $service = new Service();

            $service->price = $request->price;
            $service->description = $request->description;
            $service->status = 1;
            $service->save();

            $service->name = $request->name;
            $service->save();
            Cache::forget('services');

            session()->flash('add');
            return redirect()->route('services.index');

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


        public function update($request , $id){
        try {
            $service = Service::findOrFail($id);
            $service->price = $request->price;
            $service->name = $request->name;
            $service->description = $request->description;
            $service->status = $request->status;
            $service->save();
            Cache::forget('services');

            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        try{
            $service = Service::findOrFail($request->id);
            $service->delete();
            Cache::forget('services');
            session()->flash('delete');
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

