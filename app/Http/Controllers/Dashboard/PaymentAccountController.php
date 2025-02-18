<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Finance\PaymentRequest;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    private $Payment;

    public function __construct(PaymentRepositoryInterface $Payment)
    {
        $this->Payment = $Payment;
    }
    public function index()
    {
        return $this->Payment->index();
    }


    public function create()
    {
        return $this->Payment->create();
    }


    public function store(PaymentRequest $request)
    {
        return $this->Payment->store($request);
    }


    public function show($id)
    {
        return $this->Payment->show($id);
    }


    public function edit($id)
    {
        return $this->Payment->edit($id);
    }


    public function update(PaymentRequest $request , $id)
    {
        return $this->Payment->update($request , $id);
    }


    public function destroy(Request $request)
    {
        return $this->Payment->destroy($request);
    }

    public function get_amount($id){
        return $this->Payment->get_amount($id);
    }
}
