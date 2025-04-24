<?php


namespace App\Repository\Finance;


use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Notifications\AddReceiptNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ReceiptRepository implements ReceiptRepositoryInterface
{

    public function index()
    {
        $receipts = ReceiptAccount::with('patients.translations')->get();
        
        return view('Dashboard.Receipt.index',compact('receipts'));
    }

    public function create()
    {
        $Patients = Cache::remember('Patients', 3600 , function(){
            return Patient::with('invoice' , 'translations')->get();
        });
        return view('Dashboard.Receipt.add',compact('Patients'));
    }

    public function show($id)
    {
        $receipt = ReceiptAccount::with('patients.translation')->findOrFail($id);
        return view('Dashboard.Receipt.print',compact('receipt'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try{
            // store receipt_accounts
            $receipt_accounts = new ReceiptAccount();
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->amount = $request->amount;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->receipt_account_id = $receipt_accounts->id;
            $fund_accounts->debit = $request->amount;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_account_id = $receipt_accounts->id;
            $patient_accounts->debit = 0.00;
            $patient_accounts->credit =$request->amount;
            $patient_accounts->save();

            DB::commit();
            Cache::forget('patient_accounts');
            Cache::forget('receipts');
            Cache::forget('fund_accounts');
            $patient = Patient::find($request->patient_id);
            Notification::send($patient, new AddReceiptNotification($request->amount));
            session()->flash('add');
            return redirect()->route('receipts.create');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $receipt_accounts = ReceiptAccount::findOrFail($id);
        $Patients = Cache::remember('Patients', 3600 , function(){
            return Patient::with('invoice' , 'translations')->get();
        });
        return view('Dashboard.Receipt.edit',compact('receipt_accounts','Patients'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try{
            // store receipt_accounts
            $receipt_accounts = ReceiptAccount::findorfail($request->id);
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->amount = $request->amount;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = FundAccount::where('receipt_account_id',$request->id)->first();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->receipt_account_id = $receipt_accounts->id;
            $fund_accounts->debit = $request->amount;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = PatientAccount::where('receipt_account_id',$request->id)->first();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_account_id = $receipt_accounts->id;
            $patient_accounts->debit = 0.00;
            $patient_accounts->credit =$request->amount;
            $patient_accounts->save();


            DB::commit();
            Cache::forget('patient_accounts');
            Cache::forget('receipts');
            Cache::forget('fund_accounts');
            session()->flash('edit');
            return redirect()->route('receipts.index');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            ReceiptAccount::destroy($id);
            Cache::forget('receipts');
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
