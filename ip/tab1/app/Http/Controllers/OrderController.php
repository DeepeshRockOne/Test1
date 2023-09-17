<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;

class OrderController extends Controller
{
    public function viewTest1() {
        return view('test1');
    }

    public function viewTest2($param1 = null) {
        if ($param1 != null) {
            $param1 = $param1;
        }

        return view('test2', compact('param1'));
    }

    public function redirectToTest2() {
        return redirect()->route('view.test2')->with('success', 'Redirected using name.');
    }

    public function viewOrders() {
        /* $or = new Order();

        $or->price = 200;
        $or->order_date = "08/17/2023";
        $or->cust_id = 2;

        $or->save(); */

        $data = Order::join('customers', 'orders.cust_id', '=', 'customers.id')
                ->get(['orders.*', 'customers.name as cutomer_name']);

        return view('test3', compact('data'));
    }

    public function viewTest4() {
        return view('test4');
    }

    public function viewTest5() {
        return view('test5');
    }

    public function sendEemailTest5() {

        $details['email'] = 'deepesh.akjn@gmail.com';

        dispatch(new SendEmailJob($details));

        return redirect()->route('view.test5')->with('success', 'Email sending started.');
    }
}
