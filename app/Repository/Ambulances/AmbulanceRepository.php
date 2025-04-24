<?php


namespace App\Repository\Ambulances;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Models\Ambulance;
use Illuminate\Support\Facades\Cache;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances = Ambulance::with('translations')->get();
        return view('Dashboard.Ambulances.index',compact('ambulances'));
    }

    public function create()
    {
        return view('Dashboard.Ambulances.create');
    }

    public function store($request)
    {
        try {

        $ambulances = new Ambulance();
        $ambulances->car_number = $request->car_number;
        $ambulances->car_model = $request->car_model;
        $ambulances->car_year_made = $request->car_year_made;
        $ambulances->driver_license_number = $request->driver_license_number;
        $ambulances->driver_phone = $request->driver_phone;
        $ambulances->is_available = 1;
        $ambulances->car_type = $request->car_type;
        $ambulances->save();

        //insert trans
        $ambulances->driver_name = $request->driver_name;
        $ambulances->notes = $request->notes;
        $ambulances->save();

        session()->flash('add');
        return redirect()->back();

        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        return view('Dashboard.Ambulances.edit',compact('ambulance'));
    }

    public function update($request)
    {
        if (!$request->has('is_available'))
            $request->request->add(['is_available' => 2]);
        else
            $request->request->add(['is_available' => 1]);

        $ambulance = Ambulance::findOrFail($request->id);

        $ambulance->update($request->all());

        // insert trans
        $ambulance->driver_name = $request->driver_name;
        $ambulance->notes = $request->notes;
        $ambulance->save();


        session()->flash('edit');
        return redirect()->route('ambulances.index');
    }

    public function destroy($id)
    {
        Ambulance::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }
}
