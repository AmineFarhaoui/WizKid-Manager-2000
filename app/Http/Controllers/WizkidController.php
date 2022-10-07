<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\WizKidResource;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class WizkidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wizkids = User::get();

        if(!$wizkids){
            return response()->json(['error' => 'CANNOT_FIND_WIZKIDS'], 400);
        }

        return WizKidResource::collection($wizkids, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        // create new user
        $wizkid = User::create(array_merge(
            $data,
            ['password' => Hash::make($data['password'])],
        ));

        return response()->json([
            $wizkid,
            200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new WizKidResource(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::find($id);

        // if (in_array('password', $data)) {
        //     if (!Hash::check($data['password'], $user->password)) {
        //         return 'good';
        //         return response()->json(['error' => 'WRONG_PASSWORD_GIVEN'], 400);
        //     }
        // }

        if(!$request->hasAny(['name', 'email', 'role', 'phone_number', 'password'])) {
            return response()->json(['error' => 'NO_NEW_DATA_TO_UPDATE'], 400);
        }

        $user->update($request->validated());

        return response()->json([$user, 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);

        return response()->json([$user, 200]);
    }
}
