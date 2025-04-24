<?php

namespace App\Interfaces\Rays;

interface RaysRepositoryInterface
{
    public function store($request);

    public function update($request,$id);

    public function destroy($id);
}
