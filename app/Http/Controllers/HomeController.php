<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\User;
use App\RoomTypes;
use App\Locations;
use App\Booking;
use App\Rooms;
use Illuminate\Support\Facades\Auth;
use Laravelista\Comments\Commentable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //home page
    public function index()
    {
        // $read = DB::table('rooms')
        //     ->take(3)->get()->orderBy('something', 'asc');
        $read = DB::table('room_frequency')
            ->join('rooms','rooms.id','=','room_frequency.room_id')
            ->join('room_type','room_type.type_id','=','type')
            ->join('location','rooms.location','=','location.lid')
            ->take(3)->get();
        $categories = DB::table('room_type')
            ->get();
        $locals = Locations::all();
        return view('home')->with('rooms',$read)->with('categories',$categories)->with('locations',$locals);
    }

    public function rooms()
    {
        $rooms = DB::table('rooms')
            ->join('room_type','room_type.type_id','=','type')
            ->join('location','rooms.location','=','location.lid')
            ->paginate(3);
        $categories = DB::table('room_type')
            ->get();
        $locals = Locations::all();
        return view('pages.rooms')->with('rooms',$rooms)->with('categories',$categories)->with('locations',$locals);
    }

    //room type page
    public function roomtypes($rid)
    {
        $rooms = "";
        $cate = DB::table('room_type')->where('type_id','=',$rid)->get();
        $roomcount =DB::table('rooms')
            ->where('type','=',$rid)
            ->get();
        if(12 > count($roomcount)){
            $rooms = DB::table('rooms')
                ->join('room_type','room_type.type_id','=','type')
                ->join('location','rooms.location','=','location.lid')
                ->where('type','=',$rid)
                ->paginate();
        }else{
            $rooms = DB::table('rooms')
                ->join('room_type','room_type.type_id','=','type')
                ->join('location','rooms.location','=','location.lid')
                ->where('type','=',$rid)
                ->get();
        }
        $categories = DB::table('room_type')
            ->get();
        $locals = Locations::all();
        return view('pages.room_type_page')->with('rooms',$rooms)->with('cate',$cate)->with('categories',$categories)->with('locations',$locals);;
    }

    //details of room
    public function roomdetails($rid)
    {
        $rom = Rooms::where('rooms.id','=',$rid)
            ->join('room_type','room_type.type_id','=','type')
            ->join('location','location.lid','=','location')
            ->get();
        $arr = json_decode($rom, TRUE);
        if (!Auth::guest()){
            $arr[] = ['user_id' => Auth::user()->id];
        }

        $room = json_encode($arr);

        $rating = DB::table('ratings')
            ->where('product_id','=',$rid)
            ->avg('rating');
        $categories = DB::table('room_type')
            ->get();
        return view('pages.room_details')->with('room',$rom)->with('groot',$room)->with('rating',$rating)->with('categories',$categories);
    }
    public function createroom(){
        $rooms = RoomTypes::all();
        $locations = Locations::all();
        return view('pages.create_room')->with('types',$rooms)->with('locations',$locations);
    }
    public function history(){
        if (Auth::user()->is_admin == 1){
            $log = DB::table('bookings')
                ->where('bookings.is_Admin','=',Auth::user()->id)
                ->join('users','users.id','=','user_id')
                ->get();
                return view('pages.history')->with('logs',$log);
        }else{
            $log = DB::table('bookings')
        ->where('bookings.user_id','=',Auth::user()->id)
            ->join('users','users.id','=','user_id')
            ->get();
            return view('pages.history')->with('logs',$log);
        }

    }

    public function locations($lid){

        $categories = DB::table('room_type')
                ->get();

        $articles =  DB::table('rooms')
            ->where('location','=',$lid)
            ->get();

        $locals = Locations::all();

        return view('pages.search')->with('rooms',$articles)->with('categories',$categories)->with('locations',$locals);
    }

    public function searchthree($qid,$rid, $lid){
        $query = $qid;

        $categories = DB::table('room_type')
                ->get();

        $articles = Rooms::search($query)->where('type','=',$rid)->where('location','=',$lid)->get();

        $locals = Locations::all();

        return view('pages.search')->with('rooms',$articles)->with('categories',$categories)->with('locations',$locals);
    }
    public function searchone($qid){
        $query = $qid;

        $categories = DB::table('room_type')
                ->get();

        $articles = Rooms::search($query)->get();

        $locals = Locations::all();

        return view('pages.search')->with('rooms',$articles)->with('categories',$categories)->with('locations',$locals);
    }

    public function slider($sid){

        $categories = DB::table('room_type')
                ->get();

        $articles =  DB::table('rooms')
            ->where('price','<',$sid)
            ->get();

        $locals = Locations::all();

        return view('pages.search')->with('rooms',$articles)->with('categories',$categories)->with('locations',$locals);
    }

    public function mail()
    {
        $user = User::find(1)->toArray();
        Mail::send('emails.mailEvent', $user, function($message) use ($user) {
            $message->to("simonkioko31@gmail.com");
            $message->subject('Mailgun Testing');
        });
        dd('Mail Send Successfully');
    }

    public function invoice($id,$no)
    {
        $poc = DB::table('rooms')
            -> where('rooms.id','=',$id)
            ->join('users','users.id','=','rooms.user_id')
            ->get();
        return view('pages.invoice')->with('id',$id)->with('no',$no)->with('poc',$poc);
    }

    public function fakeLogin($id,$pid,$tid)
    {
        Auth::loginUsingId($id);

        return redirect("/invoice/$pid/$tid");
    }

}
