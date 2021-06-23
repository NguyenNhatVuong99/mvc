<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
class Debt extends Model
{
    protected $table = 'debts';
    protected $fillable = ['note','user_id', 'supplier_id', 'document', 'date', 'category', 'credit', 'debit'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }
    public static function store($request,$category){
        $debt=new Debt();
        $debt->partner_id=$request->partner_id;
        $debt->partner_code=$request->partner_code;
        $debt->category=$category;
        $debt->document_code=$request->document_code;
        $debt->document_date=$request->document_date;
        if($request->debit){
            $debt->debit=$request->debit;
        }
        else{
            $debt->credit=$request->credit;
        }
        $debt->save();
    }
    public static function createDebit($partner_id,$partner_code,$debt_cat,$code,$request){
        $debt=new Debt();
        $debt->partner_id=$partner_id;
        $debt->partner_code=$partner_code;
        $debt->category=$debt_cat;
        $debt->partner_id=$partner_id;
        $debt->document_code=$code;
        $debt->document_date=$request->date_import;
        $debt->debit=$request->debt;
        $debt->save();
    }
    public static function createCredit($request){
        $debt=new Debt();
        $debt->partner_id=$partner_id;
        $debt->partner_code=$partner_code;
        $debt->category=$debt_cat;
        $debt->partner_id=$partner_id;
        $debt->document_code=$code;
        $debt->document_date=$request->date_import;
        $debt->debit=$request->debt;    
        $debt->save();
    }
    public static function updateStatus($request)
    {

        $debt = Debt::where('document', $request->document)
            ->where('status', 0)
            ->first();
        $debt->document = $request->code;
        $debt->status = 1;
        $debt->save();
        return true;

    }
    public static function CNPC($request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $dauky = Debt::selectRaw('supplier_id,SUM(debit) as debit,
                        SUM(credit) as credit')->where('category', 'CNPC')
            ->where('date', '<', $start)->where('status', 1)
            ->groupByRaw('supplier_id')
            ->with('supplier')
            ->get()
            ->toArray();
        $phatsinh = Debt::selectRaw('supplier_id,SUM(debit) as debit,
                        SUM(credit) as credit')->where('category', 'CNPC')
            ->where('status', 1)
            ->whereBetween('date', [$start, $end])->groupByRaw('supplier_id')
            ->with('supplier')
            ->get()
            ->toArray();
        $debt = array();
        foreach ($dauky as $key_dk => $dk)
        {
            foreach ($phatsinh as $key_ps => $ps)
            {
                if ($ps['supplier_id'] == $dk['supplier_id'])
                {
                    $object = (object)['supplier_id' => $ps['supplier_id'], 'code' => $ps['supplier']['code'], 'name' => $ps['supplier']['name'], 'address' => $ps['supplier']['address'], 'no_dau_ky' => $dk['debit'], 'co_dau_ky' => $dk['credit'], 'no_phat_sinh' => $ps['debit'], 'co_phat_sinh' => $ps['credit'], 'no_cuoi_ky' => $dk['debit'] + $ps['debit'] - $ps['credit'], 'co_cuoi_ky' => $dk['credit'] + $ps['credit'] - $ps['debit']];
                    array_push($debt, $object);
                    unset($dauky[$key_dk]);
                    unset($phatsinh[$key_ps]);
                }
            }
        }
        foreach ($dauky as $key_dk => $dk)
        {
            $object = (object)['supplier_id' => $dk['supplier_id'], 'code' => $dk['supplier']['code'], 'name' => $dk['supplier']['name'], 'address' => $dk['supplier']['address'], 'no_dau_ky' => $dk['debit'], 'co_dau_ky' => $dk['credit'], 'no_phat_sinh' => 0, 'co_phat_sinh' => 0, 'no_cuoi_ky' => $dk['debit'], 'co_cuoi_ky' => $dk['credit']];
            array_push($debt, $object);
        }
        foreach ($phatsinh as $key_ps => $ps)
        {
            $object = (object)['supplier_id' => $ps['supplier_id'], 'code' => $ps['supplier']['code'], 'name' => $ps['supplier']['name'], 'address' => $ps['supplier']['address'], 'no_dau_ky' => 0, 'co_dau_ky' => 0, 'no_phat_sinh' => $ps['debit'], 'co_phat_sinh' => $ps['credit'], 'no_cuoi_ky' => $ps['debit'], 'co_cuoi_ky' => $ps['credit']];
            array_push($debt, $object);
        }
        return $debt;
    }
    public static function CNPT($request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $dauky = Debt::selectRaw('user_id,SUM(debit) as debit,
                        SUM(credit) as credit')->where('category', 'CNPT')
            ->where('date', '<', $start)->where('status', 1)
            ->groupByRaw('user_id')
            ->with('user')
            ->get()
            ->toArray();
        $phatsinh = Debt::selectRaw('user_id,SUM(debit) as debit,
                        SUM(credit) as credit')->where('category', 'CNPT')
            ->whereBetween('date', [$start, $end])->where('status', 1)
            ->groupByRaw('user_id')
            ->with('user')
            ->get()
            ->toArray();

        $debt = array();
        foreach ($dauky as $key_dk => $dk)
        {
            foreach ($phatsinh as $key_ps => $ps)
            {
                if ($ps['user_id'] == $dk['user_id'])
                {
                    $object = (object)['user_id' => $ps['user_id'], 'code' => $ps['user']['code'], 'name' => $ps['user']['name'], 'no_dau_ky' => $dk['debit'], 'co_dau_ky' => $dk['credit'], 'no_phat_sinh' => $ps['debit'], 'co_phat_sinh' => $ps['credit'], 'no_cuoi_ky' => $dk['debit'] + $ps['debit'] - $ps['credit'], 'co_cuoi_ky' => $dk['credit'] + $ps['credit'] - $ps['debit']];
                    array_push($debt, $object);
                    unset($dauky[$key_dk]);
                    unset($phatsinh[$key_ps]);
                }
            }
        }
        foreach ($dauky as $key_dk => $dk)
        {
            $object = (object)['user_id' => $dk['user_id'], 'code' => $dk['user']['code'], 'name' => $dk['user']['name'], 'no_dau_ky' => $dk['debit'], 'co_dau_ky' => $dk['credit'], 'no_phat_sinh' => 0, 'co_phat_sinh' => 0, 'no_cuoi_ky' => $dk['debit'], 'co_cuoi_ky' => $dk['credit']];
            array_push($debt, $object);
        }
        foreach ($phatsinh as $key_ps => $ps)
        {
            $object = (object)['user_id' => $ps['user_id'], 'code' => $ps['user']['code'], 'name' => $ps['user']['name'], 'no_dau_ky' => 0, 'co_dau_ky' => 0, 'no_phat_sinh' => $ps['debit'], 'co_phat_sinh' => $ps['credit'], 'no_cuoi_ky' => $ps['debit'], 'co_cuoi_ky' => $ps['credit']];
            array_push($debt, $object);
        }

        return $debt;
    }
    public static function show($request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        if ($request->user_id)
        {
            $data['dauky'] = Debt::selectRaw('SUM(debit) as debit,
            SUM(credit) as credit')->where('category', $request->cat)
                ->where('date', '<', $start)
                ->where('user_id', $request->user_id)
                ->where('status',1)
                ->groupByRaw('user_id')
                ->first();
            
            $data['phatsinh'] = Debt::selectRaw('SUM(debit) as debit,
                    SUM(credit) as credit')->where('category', $request->cat)
                ->whereBetween('date', [$start, $end])
                ->where('user_id', $request->user_id)
                ->where('status',1)
                ->groupByRaw('user_id')
                ->first();
                $data['detail_phatsinh']=Debt::whereBetween('date', [$start, $end])
                            ->where('user_id', $request->user_id)
                            ->where('status',1)
                            ->get();
        }
        else{
            $data['dauky'] = Debt::selectRaw('SUM(debit) as debit,
            SUM(credit) as credit')->where('category', $request->cat)
                ->where('date', '<', $start)
                ->where('supplier_id', $request->supplier_id)
                ->where('status',1)
                ->groupByRaw('supplier_id')
                ->first();
            $data['phatsinh'] = Debt::selectRaw('SUM(debit) as debit,
                    SUM(credit) as credit')->where('category', $request->cat)
                ->whereBetween('date', [$start, $end])
                ->where('supplier_id', $request->supplier_id)
                ->where('status',1)
                ->groupByRaw('supplier_id')
                ->first();
                $data['detail_phatsinh']=Debt::whereBetween('date', [$start, $end])
                            ->where('supplier_id', $request->supplier_id)
                            ->where('status',1)
                            ->get();
        }
            if ($data['phatsinh'] == null)
            {
                $data['phatsinh']['debit'] = 0;
                $data['phatsinh']['credit'] = 0;
            }
            if ($data['dauky'] == null)
            {
                $data['dauky']['debit'] = 0;
                $data['dauky']['credit'] = 0;
            }
            $data['cuoiky'] = array();
            $data['cuoiky'] = (object)[
                            'debit' => $data['dauky']['debit'] + $data['phatsinh']['debit'] - $data['phatsinh']['credit'], 
                            'credit' => $data['dauky']['credit'] + $data['phatsinh']['credit'] - $data['phatsinh']['debit']
                        ];
            return $data;


    }
}

