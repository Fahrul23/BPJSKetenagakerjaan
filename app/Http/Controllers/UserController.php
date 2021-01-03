<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\UserRequest;
use App\User;
use App\Category;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $this->authorize('viewAny', $user);
        $users = User::all();
        return view('user', compact('users'));
    }

    public function create()
    {
        $roles = ['admin', 'user'];
        return view('user_tambah', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, User $user)
    {
        $this->authorize('create', $user);
        $data = (object) $request->validated();
        try {
            $input['name'] = $data->name;
            $input['email'] = $data->email;
            $input['role'] = $data->role;
            $input['password'] = Hash::make("user123");
            $user = User::create($input);
            if ($user->save()) {
                $alert = ['success', 'Berhasil menambahkan data user!'];
            } else {
                $alert = ['danger', 'Gagal menambahkan data user!'];
            }
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menambahkan data user!'];
        }

        return back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $r, User $user)
    {
        $this->authorize('forceDelete', $user->onlyTrashed()->where('id', $r->id)->first());
        $item = User::onlyTrashed()->where('id', $r->id);
        try {
            $item->forceDelete();
            $alert = ['success', 'Data user berhasil dihapus secara permanen'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data user gagal dihapus secara permanen'];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $r, User $user)
    {
        $this->authorize('delete', $user->find($r->id));
        try {
            User::find($r->id)->delete();
            $alert = ['success', 'Data user berhasil dihapus'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data user gagal dihapus'];
        }
        return back()->with('alert', $alert);
    }



    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id, User $user)
    {
        $this->authorize('restore', $user->onlyTrashed()->where('id', $id)->first());
        try {
            User::onlyTrashed()->where('id', $id)->restore();
            $alert = ['success', 'Data user berhasil dikembalikan'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data user gagal dikembalikan'];
        }
        return back()->with('alert', $alert);
    }

    public function history()
    {
        $histories = User::onlyTrashed()->get();
        return view('user_riwayat', compact('histories'));
    }
}
