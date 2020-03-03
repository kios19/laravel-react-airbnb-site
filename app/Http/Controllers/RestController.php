<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Booking;
use App\Rating;
use App\Payments;
use App\Rooms;
use Illuminate\Support\Facades\Hash;

class RestController extends Controller
{
    //
    public function createBooking(Request $request){

        $from = $request->start_time;
        $to = $request->end_time;
        $flower = Booking::where(function ($query) use ($from, $to) {
                $query->where(function ($query) use ($from, $to) {
                    $query->where('start_time', '<=', $from)
                        ->where('end_time', '>=', $from);
                })->orWhere(function ($query) use ($from, $to) {
                    $query->where('start_time', '<=', $to)
                        ->where('end_time', '>=', $to);
                })->orWhere(function ($query) use ($from, $to) {
                    $query->where('start_time', '>=', $from)
                        ->where('end_time', '<=', $to);
                });
            })->get();

        $book = new Booking;

        $book->title = $request->title;
        $book->type = $request->type;
        $book->no_guests = $request->guests;
        $book->children = $request->children;
        $book->adults = $request->adults;
        $book->beds = $request->beds;
        $book->price = $request->price;
        $book->location = $request->location;
        $book->description = $request->description;
        $book->deposit = $request->deposit;
        $book->condition = $request->condition;
        $book->image1 = $request->image1;
        $book->image2 = $request->image2;
        $book->image3 = $request->image3;
        $book->start_time = $request->start_time;
        $book->end_time = $request->end_time;
        $book->user_id = $request->user_id;
        $book->room_id = $request->room_id;
        $book->is_Admin = $request->admin_id;

        $a = array();
        foreach ($flower as $flos){
            //print($flos->room_id);
            array_push($a, $flos->room_id);

        }

        if(in_array($request->room_id,$a)){
            return 401;
        }else{
            $book->save();
            return 200;
        }
    }

    public function checkBooking(Request $request)
    {
        $book = new Booking;
        //$flower = $book::whereBetween('start_time',array($request->start_time, $request->end_time))->get();
        /*
        $flower = $book::where(DB::raw("? between start_time and end_time",$request->start_time))
           ->orWhere(DB::raw("? between start_time and end_time",$request->end_time))
            ->get();*/
        $from = $request->start_time;
        $to = $request->end_time;
        $flower = Booking::where(function ($query) use ($from, $to) {
            $query->where(function ($query) use ($from, $to) {
                $query->where('start_time', '<=', $from)
                    ->where('end_time', '>=', $from);
            })->orWhere(function ($query) use ($from, $to) {
                $query->where('start_time', '<=', $to)
                    ->where('end_time', '>=', $to);
            })->orWhere(function ($query) use ($from, $to) {
                $query->where('start_time', '>=', $from)
                    ->where('end_time', '<=', $to);
            });
        })->count();
        return response()->json([
            "message" => $flower
        ], 200);
    }
    public function checkBooked(Request $request)
    {
        $check = DB::table('ratings')
            ->where('user_id','=',$request->userid)
            ->where('product_id','=',$request->productid)
            ->get();
        $chet = "false";
        if(count($check) > 0)
        {
            $chet="true";
        }
        return $chet;
    }

    public function rateme(Request $request)
    {
        $rate = new Rating;

        $rate->user_id = $request->userid;
        $rate->product_id = $request->product_id;
        $rate->rating = $request->rating;



        try {
            $rate->save();
            return 200;
        } catch (\PDOException $e) {
            return $e->getMessage();;
        }

        //return "200";
    }

    public function payme(Request $request)
    {
        $pay = new Payments;

        $pay->room_id = $request->room_id;
        $pay->user_id = $request->user_id;
        $pay->amount = $request->amount;
        if($request->error)
        {
            $pay->error = $request->error;
        }


        try {
            $pay->save();
            return 200;
        } catch (\PDOException $e) {
            return $e->getMessage();;
        }

        //return "200";
    }

    public function login(Request $request)
    {
        //$user = User::findOrFail($request->userid);
        $person = DB::table('users')
            ->where('email','=',$request->email)
            ->get();
        return $person;
    }

    public function checkpass(Request $request){

        return json_encode(Hash::check( $request->usergiv, $request->password, []));
    }

    public function enabler(Request $request){
        $check = DB::table('bookings')
            ->where('user_id','=',$request->userid)
            ->where('room_id','=',$request->roomid)
            ->count();
        return $check;
    }

    public function playme(Request $request){
        try{
            $mas = "0";
            $from = $request->start_time;
            $to = $request->end_time;

            $flower = Booking::where(function ($query) use ($from, $to) {
                $query->where(function ($query) use ($from, $to) {
                    $query->where('start_time', '<=', $from)
                        ->where('end_time', '>=', $from);

                })->orWhere(function ($query) use ($from, $to) {
                    $query->where('start_time', '<=', $to)
                        ->where('end_time', '>=', $to);
                })->orWhere(function ($query) use ($from, $to) {
                    $query->where('start_time', '>=', $from)
                        ->where('end_time', '<=', $to);
                });
            })->get();

            $a = array();
            foreach ($flower as $flos){
                //print($flos->room_id);
                array_push($a, $flos->room_id);

            }

            if(in_array($request->roomid,$a)){
                return 1;
            }else{
                return 0;
            }
        }catch (\Exception $e) {
            return $e->getMessage();;
        }
    }
    public function deactivate(Request $request)
    {

        try {
            $dec = Rooms::where('id','=',$request->rid)
            ->delete();
            return 200;
        } catch (\PDOException $e) {
            return $e->getMessage();;
        }

    }
    public function ispaid(Request $request)
    {
        try {
            $dec = Booking::where('room_id','=',$request->rid)
            ->update(['paid'=>1]);
            return 200;
        } catch (\PDOException $e) {
            return $e->getMessage();;
        }
    }

    public function cancelled(Request $request)
    {
        try {
            $dec = Booking::where('room_id','=',$request->rid)
            ->update(['cancelled'=>1]);
            return 200;
        } catch (\PDOException $e) {
            return $e->getMessage();;
        }
    }

    public function goterror(Request $request)
    {
        try {
            $dec = Booking::where('room_id','=',$request->rid)
            ->update(['cancelled'=>1,'error'=>$request->error]);
            return 200;
        } catch (\PDOException $e) {
            return $e->getMessage();;
        }
    }
}
