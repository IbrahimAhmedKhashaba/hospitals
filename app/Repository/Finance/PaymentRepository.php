<?php


namespace App\Repository\Finance;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use App\Notifications\AddPaymentNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payments = PaymentAccount::with(['patients.translations'])->get();
        
        return view('Dashboard.Payment.index',compact('payments'));
    }

    public function create()
    {
        $Patients = Patient::with('invoice' , 'translations')->get();
        
        return view('Dashboard.Payment.add',compact('Patients'));
    }

    public function show($id)
    {
        $payment_account = PaymentAccount::with('patients.translations')->findOrFail($id);
        return view('Dashboard.Payment.print',compact('payment_account'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            // store receipt_accounts
            $payment_accounts = new PaymentAccount();
            $payment_accounts->date =date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->amount;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();


            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->payment_account_id = $payment_accounts->id;
            $fund_accounts->credit = $request->amount;
            $fund_accounts->debit = 0.00;
            $fund_accounts->save();



            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_account_id = $payment_accounts->id;
            $patient_accounts->Debit = $request->amount;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();


            DB::commit();
            


            $patient = Patient::find($request->patient_id);
            Notification::send($patient, new AddPaymentNotification($request->amount));
            session()->flash('add');
            return redirect()->route('payments.index');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $payment_accounts = PaymentAccount::findOrFail($id);
        $Patients = Patient::with('invoice' , 'translations')->get();
        
        return view('Dashboard.Payment.edit',compact('payment_accounts','Patients'));
    }

    public function update($request , $id)
    {
        DB::beginTransaction();

        try {

            // update receipt_accounts
            $payment_accounts = PaymentAccount::findOrFail($id);
            $payment_accounts->date =date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->amount;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();

            // update fund_accounts
            $fund_accounts = FundAccount::where('payment_account_id',$payment_accounts->id)->first();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->payment_account_id = $payment_accounts->id;
            $fund_accounts->credit = $request->amount;
            $fund_accounts->debit = 0.00;
            $fund_accounts->save();

            // update patient_accounts
            $patient_accounts = PatientAccount::where('payment_account_id',$payment_accounts->id)->first();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_account_id = $payment_accounts->id;
            $patient_accounts->debit = $request->amount;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            DB::commit();
            
            session()->flash('edit');
            return redirect()->route('payments.index');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            PaymentAccount::destroy($request->id);
            
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function get_amount($id){
        $totalCredit = PatientAccount::sum('credit');
        $totalDebit = PatientAccount::sum('debit');

        $amount = $totalCredit - $totalDebit;

        return response()->json(['amount' => $amount,]);
    }
}
