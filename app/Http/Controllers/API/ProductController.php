<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\User;

class ProductController extends Controller
{

    /**
     * Returns all users - paginated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::paginate(10);

        return response()->json($users, 200);
    }

    /**
     * Get a role by id
     *
     * @param $id role_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->UserRepository->findById($id);

        return response()->json($user, 200);
    }
}
