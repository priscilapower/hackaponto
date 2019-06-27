<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserRepository
{
    /**
     * @param User $model
     * @return mixed
     */
    public function index(User $model)
    {
        return $model->paginate(10);
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
     * @param Request $request
     * @param $model
     * @return mixed
     */
    public function store(Request $request, $model)
    {
        $foto = base64_encode(file_get_contents($request->file('foto')));

        $data['foto'] = "data:image/jpeg;base64,".$foto;
        $data['nome'] = $request->nome;
        $data['email'] = $request->email;
        $data['usuario'] = $request->usuario;
        $data['password'] = Hash::make($request->password);

        return $model->create($data);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $foto = base64_encode(file_get_contents($request->file('foto')));

        $request->foto = "";
        $data['id'] = $id;
        $data['foto'] = "data:image/jpeg;base64,".$foto;
        $data['nome'] = $request->nome;
        $data['email'] = $request->email;
        $data['usuario'] = $request->usuario;

        if(!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id','=',$id)->update($data);
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
