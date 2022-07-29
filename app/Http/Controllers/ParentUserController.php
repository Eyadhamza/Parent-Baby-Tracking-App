<?php

namespace App\Http\Controllers;

use App\Models\ParentUser;

class ParentUserController extends Controller
{
    public function invite()
    {
        auth()->user()->invite(request('parent_id'));

        return response()->json(['message' => 'Invitation sent']);
    }
}
