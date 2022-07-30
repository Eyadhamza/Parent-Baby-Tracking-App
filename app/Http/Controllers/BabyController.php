<?php

namespace App\Http\Controllers;


use App\Http\Requests\BabyStoreRequest;
use App\Http\Resources\BabyResource;
use App\Models\Baby;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Baby Resource
 *
 * APIs for Baby Resource Management
 */
class BabyController extends Controller
{
    /**
     * All Babies.
     *
     * @response 401 scenario="Unauthenticated" {"message": "Unauthenticated"}
     *
     * @apiResourceCollection App\Http\Resources\BabyResource
     *
     * @apiResourceModel App\Models\Baby
     *
     * @responseField data "list of all Babies"
     */
    public function index(): AnonymousResourceCollection
    {
        return BabyResource::collection(Baby::all());
    }

    /**
     * Store a Baby.
     */
    public function store(BabyStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (auth()->check()) {
            $baby = auth()
                ->user()
                ->babies()
                ->create($data);
            return createdSuccessfullyResponse();
        }

        return validationFailed('Unauthenticated');
    }

    /**
     * Show Baby.
     *
     * @response 401 scenario="Unauthenticated" {"message": "Unauthenticated"}
     *
     * @apiResource App\Http\Resources\BabyResource
     *
     * @apiResourceModel App\Models\Baby
     *
     * @responseField data " App\Models\Baby Info"
     * Return a one App\Models\Baby by id
     */
    public function show(Baby $baby): BabyResource
    {
        return new BabyResource($baby);
    }

    /**
     * Update a specified Baby - Not Implemented.
     */
    public function update(BabyStoreRequest $request, Baby $baby): JsonResponse
    {
        $data = $request->validated();

        if (auth()->check()) {
            $baby->update($data);

            return updatedSuccessfullyResponse();
        }

        return validationFailed('Unauthenticated');
    }

    /**
     * Remove a specified Baby - Not Implemented.
     */
    public function destroy(Baby $baby): JsonResponse
    {
        if (auth()->check()) {
            $baby->delete();

            return deletedSuccessfullyResponse();
        }

        return validationFailed('Unauthenticated');
    }
}

