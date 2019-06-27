<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\LoginRepository;
use App\Repositories\UserRepository;
use App\User;
use App\Http\Requests\UserRequest;
use http\Env\Response;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userRepository;
    protected $loginRepository;

    public function __construct(UserRepository $userRepository, LoginRepository $loginRepository)
    {
        $this->userRepository = $userRepository;
        $this->loginRepository = $loginRepository;
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = $this->userRepository->index($model);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        try {
            $this->userRepository->store($request, $model);

            return redirect()->route('user.index')->withStatus(__('Usuário criado com sucesso.'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('user.index')->withErrors(__('Ocorreu um erro.'));
        }
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $this->userRepository->update($request, $id);

            return redirect()->route('user.index')->withStatus(__('Usuário atualizado com sucesso'));
        } catch (\Exception $e) {
            return redirect()->route('user.index')->withErrors(__('Ocorreu um erro.'));
        }
    }

    /**
     * Remove the specified user from storage
     *
     * @param User $model
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $this->userRepository->destroy($id);

            return redirect()->route('user.index')->withStatus(__('Usuário excluído com sucesso.'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('user.index')->withErrors(__('Ocorreu um erro.'));
        }
    }

    public function login(LoginRequest $request){
        try {
            $user = $this->loginRepository->login($request);

            if($user === false) {
                return response()->json(['message' => 'Não foi possível realizar o login'], 500);
            }

            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
