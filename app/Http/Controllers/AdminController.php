<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Rooms;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Locations;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'guests' => 'required',
            'children' => 'required',
            'adults' => 'required',
            'beds' => 'required',
            'rooms' => 'required',
            'price' => 'required',
            'location' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'image1' => 'required',
        ]);

        $cover = $request->file('image1');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));

        if($request->file('image2'))
        {
            $cover2 = $request->file('image2');
            $extension2= $cover2->getClientOriginalExtension();
            Storage::disk('public')->put($cover2->getFilename() . '.' . $extension2, File::get($cover2));
        }

        if($request->file('image3'))
        {
            $cover3 = $request->file('image3');
            $extension3= $cover3->getClientOriginalExtension();
            Storage::disk('public')->put($cover3->getFilename() . '.' . $extension3, File::get($cover3));
        }

        $room = new Rooms;
        $room->title = $request->input('title');
        $room->type = $request->input('type');
        $room->no_guests = $request->input('guests');
        $room->children = $request->input('children');
        $room->adults = $request->input('adults');
        $room->beds = $request->input('beds');
        $room->rooms = $request->input('rooms');
        $room->price = $request->input('price');
        $room->location = $request->input('location');
        $room->description = $request->input('description');
        $room->condition = $request->input('condition');
        $room->image1 = $cover->getFilename().'.'.$extension;
        if($request->file('image2'))
        {
            $room->image2 = $cover2->getFilename().'.'.$extension2;
        }
        if($request->file('image3'))
        {
            $room->image3 = $cover3->getFilename().'.'.$extension3;
        }
        $room->user_id = Auth::user()->id;
        $room->save();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
