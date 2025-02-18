<?php
namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Section;
use Illuminate\Support\Facades\Cache;

class SectionRepository implements SectionRepositoryInterface
{
    public function index()
    {
        $sections = Cache::remember('sections' , 3600 , function(){
            return Section::with(['translations' , 'doctors.translations' , 'invoices'])->get();
        });
        return view('Dashboard.Sections.index' , compact(['sections']));
    }

    public function show($id){
        try{
           $section = Section::with(['translations'])->findOrFail($id);
           return view('Dashboard.Sections.show_doctors', compact(['section']));
        }catch(\Exception $e){

        }
    }

    public function store($request){
        Section::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        Cache::forget('sections');
        session()->flash('add');
        return redirect()->route('sections.index');
    }

        public function update($request , $id){
            try{
                $section = Section::findOrFail($id);
                $section->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                Cache::forget('sections');

                session()->flash('edit');
            } catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
            return redirect()->route('sections.index');
    }

    public function destroy($id){
        try{
            $section = Section::findOrFail($id);
            $section->delete();
            Cache::forget('sections');

            session()->flash('delete');
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('sections.index');
    }

}

