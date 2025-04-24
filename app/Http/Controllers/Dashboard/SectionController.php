<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Sections\SectionRequest;
use App\Repository\Sections\SectionRepository;

class SectionController extends Controller
{

    private $sections;

    public function __construct(SectionRepository $sections){
        $this->sections = $sections;
    }

    public function index()
    {
        //
        return $this->sections->index();
    }

    public function store(SectionRequest $request)
    {
        //
        return $this->sections->store($request);
    }

    public function show(string $id)
    {
        //
        return $this->sections->show($id);
    }

    public function update(SectionRequest $request, string $id)
    {
        //
        return $this->sections->update($request , $id);
    }

    public function destroy(string $id)
    {
        //
        return $this->sections->destroy($id);
    }
}
