<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = $this->userRepository->index($model);
        return view('users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param Request $request
     * @param User $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $model)
    {
        try {
            $this->userRepository->store($request, $model);

            return redirect()->route('user.index')->withStatus(__('Usuário criado com sucesso.'));
        } catch (ValidationException $e) {
            dd($e);
            return redirect()->route('user.index')->withErrors(__('Ocorreu um erro.'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('user.index')->withErrors(__('Ocorreu um erro.'));
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $this->userRepository->update($request, $id);

            return redirect()->route('user.index')->withStatus(__('Usuário atualizado com sucesso'));
        } catch (\Exception $e) {
            return redirect()->route('user.index')->withErrors(__('Ocorreu um erro.'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $this->userRepository->destroy($id);

            return redirect()->route('user.index')->withStatus(__('Usuário excluído com sucesso.'));
        } catch (\Exception $e) {
            return redirect()->route('user.index')->withErrors(__('Ocorreu um erro.'));
        }
    }



}
