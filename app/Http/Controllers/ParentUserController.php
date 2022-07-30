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
        auth()->user()->invite(request('parent_id'));

        return response()->json(['message' => 'Invitation sent']);
    }

}
