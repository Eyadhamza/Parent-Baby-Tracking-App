<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParentUserResource;
use App\Models\ParentUser;

class ParentUserController extends Controller
{
    public function index()
    {

        return ParentUserResource::collection(auth()->user()->partners()->get());
    }

    public function invite()
    {
        if (auth()->user()->id == request('id')) {
            return response()->json([
                'message' => 'You can not invite yourself',
            ], 400);
        }
        auth()
            ->user()
            ->invite(request('id'));

        return response()->json(['message' => 'Invitation sent']);
    }

}
