<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\item;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = item::All();

        return view('admin', compact('items'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'currency' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $imageName = $request->name.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images/Products'), $imageName);

        item::create([
            'name' => $request->name,
            'price' => $request->price,
            'currency' => $request->currency,
            'photo' => $imageName,
            'status' => 'on'
        ]);

        return redirect()->back()->with('success', 'Product created successfully.');
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
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'currency' => 'required|string',
        ]);

        if($request->status != "")
        {
            $status = 'on';
        }
        else
        {
            $status = 'off';
        }

        $item = DB::table('items')->where('id', $id)->first();

        if($request->photo != '')
        {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);

            $imageName = $request->name.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images/Products'), $imageName);
        }
        else
        {
            $imageName = $item->photo;
        }

        DB::table('items')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'currency' => $request->currency,
                'photo' => $imageName,
                'status' => $status
            ]);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('items')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
