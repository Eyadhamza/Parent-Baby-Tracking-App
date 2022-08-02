<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteParentRequest;
use App\Http\Resources\ParentUserResource;
use App\Models\ParentUser;

/**
 * @group Parents API
 *
 * API for parents to manage their partner
 */
class ParentUserController extends Controller
{
    /**
     * Show Partner.
     *
     * @response 401 scenario="Unauthenticated" {"message": "Unauthenticated"}
     *
     * @apiResourceCollection App\Http\Resources\ParentUserResource
     *
     * @apiResourceModel App\Models\ParentUser
     *
     */
    public function index()
    {

        return new ParentUserResource(auth()->user()->partner);
    }

    /**
     * Invite a parent to be your partner.
     */
    public function invite(InviteParentRequest $request)
    {
        $data = $request->validated();

        try {
            auth()
                ->user()
                ->invite($data['id']);
        } catch (\Exception $e) {
            return validationFailed($e->getMessage());
        }

        return response()->json(['message' => 'Invitation sent']);
    }

}
