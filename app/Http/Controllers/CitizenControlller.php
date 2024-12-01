<?php

namespace App\Http\Controllers;

use App\Models\citizen;
use Illuminate\Http\Request;

class CitizenControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users=citizen::all();
        // $users=citizen::select('id','name')->get();
        $users=citizen::get();
        // $users=citizen::find(2);
        // $users=citizen::find([1,2,4],['name','email']);

        // $users=citizen::count();
        // $users=citizen::min('age');
        // $users=citizen::sum('age');


        //Where Method
        // $users=citizen::where('city','Delhi')->where('age','>',19)->get();

        //Another Method
        // $users=citizen::where([
        //     ['city','Delhi'],
        //     ['age','>',19]
        // ])->get();


        //OrWhere

        // $users = citizen::where('city', 'Delhi')
        //     ->orWhere('age','>',30)
        //     ->get();


        //Count in orWhere
        // $users = citizen::where('city', 'Delhi')
        //     ->orWhere('age','>',30)
        //     ->count();


        //New Where Method

        // $users = citizen::whereCity('Delhi')
        // ->whereAge(20)
        // ->select('name','email as user email')
        // ->get();



        // $users = citizen::whereCity('Delhi')
        // ->whereAge(20)
        // ->select('name','email as user email')
        // // ->toSql();        //It is secure
        // // ->toRawSql();       //It gives exact values of the columns name
        // ->ddRawSql();


        //Different Methods

        // $users = citizen::where('Age','<>',20)
        // $users = citizen::whereNot('Age',20)
        // $users = citizen::whereBetween('Age',[20,30])
        // $users = citizen::whereIn('city',['Delhi','Bihar'])
        // $users = citizen::whereNotIn('city',['Delhi','Bihar'])
        // // ->first();
        // ->get();


        // foreach($users as $user){
        //     echo $user->name."<br>";
        // }
      $users = citizen::simplepaginate(4);

  //      return $users;
     return view('home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adduser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user= new citizen;

        // $user->name= $request->username;
        // $user->email= $request->useremail;
        // $user->age= $request->userage;
        // $user->city= $request->usercity;

        // $user->save();

        //Another Method Mass Insert

        $request->validate([
            'username' => 'required|string',
            'useremail' => 'required|email',
            'userage' => 'required|numeric',
            'usercity' => 'required|alpha',
        ]);

        // return $request;

        citizen::create([
            'name' => $request->username,
            'email' => $request->useremail,
            'age' => $request->userage,
            'city' => $request->usercity
        ]);


        return redirect()->route('user.index')
            ->with('status', 'New User Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $users = citizen::find($id);


        $users = citizen::findOrFail($id);

        return view('viewuser', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $users = citizen::find($id);

        $users = citizen::findorfail($id);
        return view('updateuser', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //     $user=citizen::find($id);
        //     $user->name=$request->username;
        //     $user->email=$request->useremail;
        //     $user->age=$request->userage;
        //     $user->city=$request->usercity;
        //     $user->save();
        //     return redirect()->route('user.index')
        //     ->with('status','User Data Updated Successfully');


        //Another Method Mass Updating 

        $request->validate([
            'username' => 'required|string',
            'useremail' => 'required|email',
            'userage' => 'required|numeric',
            'usercity' => 'required|string',
        ]);


        $user = citizen::where('id', $id)
            ->update([
                'name' => $request->username,
                'email' => $request->useremail,
                'age' => $request->userage,
                'city' => $request->usercity
            ]);

        return redirect()->route('user.index')
            ->with('status', 'User Data Updated Successfully');
    }



    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $id)
    {
        // $users=citizen::find($id);

        $users = citizen::findorfail($id);

        // $users=citizen::where('email','kv@gmail.com');
        $users->delete();

        // 2nd Method
        // citizen::destroy($id);
        // citizen::destroy([8,9]);


        return redirect()->route('user.index')
        ->with('status','User Data Deleted Successfully');
    }

    // citizen::chunk(2,function($users){
    //     foreach($users as $user){
    //         echo $user->name;
    // });
}
