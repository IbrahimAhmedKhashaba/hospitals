<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Finance\PaymentRequest;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptAccountController extends Controller
{
    private $Receipt;

    public function __construct(ReceiptRepositoryInterface $Receipt)
    {
        $this->Receipt = $Receipt;
    }


    public function index()
    {
        return $this->Receipt->index();
    }

    public function create()
    {
        return $this->Receipt->create();
    }


    public function store(PaymentRequest $request)
    {
       return $this->Receipt->store($request);
    }


    public function show($id)
    {
        return $this->Receipt->show($id);
    }


    public function edit($id)
    {
        return $this->Receipt->edit($id);
    }


    public function update(PaymentRequest $request)
    {
        return $this->Receipt->update($request);
    }


    public function destroy(Request $id)
    {
        return $this->Receipt->destroy($id);
    }
}
