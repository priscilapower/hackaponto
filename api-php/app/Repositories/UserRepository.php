<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\User;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @param User $model
     * @return mixed
     */
    public function index(User $model)
    {
        return $model->paginate(15);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * @param UserRequest $request
     * @return mixed
     */
    public function store(UserRequest $request, $model)
    {
        return $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
    }

    /**
     * @param UserRequest $request
     * @param $id
     */
    public function update(UserRequest $request, $id)
    {
        User::where('id','=',$id)->update($request->merge(['password' => Hash::make($request->get('password'))])
            ->except([$request->get('password') ? '' : 'password', '_token', '_method', 'password_confirmation']
            ));
    }

    /**
     * @param User $model
     * @throws \Exception
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}
