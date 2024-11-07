<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = Pengguna::with('user')
            ->where('nama', 'like', '%' . request('cari') . '%')
            ->orWhere('alamat', 'like', '%' . request('cari') . '%')
            ->orWhereHas('user', function ($query) {
                $query->where('no_telfon', 'like', '%' . request('cari') . '%')
                    ->orWhere('role', 'like', '%' . request('cari') . '%')
                    ->orWhere('email', 'like', '%' . request('cari') . '%');
            })
            ->paginate(20);

        return view('page.karyawan.data-karyawan', compact('data'));
    }
    public function store(Request $request)
    {
        if ($request->email == null) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                // 'email' => 'required',
                // 'password' => 'required',
                'no_telfon' => 'required|unique:users',
                'alamat' => 'required',
                'role' => 'required',

            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required',
                // 'password' => 'required',
                'no_telfon' => 'required|unique:users',
                'alamat' => 'required',
                'role' => 'required',

            ]);
            if ($validator->fails()) {
                $messages = $validator->errors()->all();
                Alert::error('Gagal', $messages);
                return back()->withErrors($validator)->withInput();
            }
            $user = new User();
            $user->email = $request->email ?? null;
            $user->password = bcrypt($request->no_telfon);
            $user->no_telfon = $request->no_telfon;
            $user->role = $request->role;
            $user->save();
            $pengguna = new Pengguna();
            $pengguna->id_user = $user->id;
            $pengguna->nama = $request->nama;
            $pengguna->alamat = $request->alamat;
            // $pengguna->role = $request->level;
            $pengguna->save();
            Alert::success('Berhasil', 'Data Berhasil di tambah');
            return redirect()->route('karyawan');
        }
    }

    public function create()
    {
        return view('page.karyawan.create-karyawan');
    }
    public function edit($id)
    {
        $pengguna = Pengguna::with('user')->find($id);
        // return view('page.karyawan.create-karyawan');
        return view('page.karyawan.edit-karyawan', compact('pengguna'));
    }

    public function hapus($id)
    {
        $pengguna = Pengguna::find($id);
        $user = User::find($pengguna->id_user);

        $file = public_path() . '/foto_profil/' . $pengguna->foto;
        if (file_exists($file)) {
            unlink($file);
        }
        $pengguna->delete();
        $user->delete();
        Alert::success('Berhasil', 'Data Berhasil di Hapus');
        return redirect()->route('karyawan');
    }
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::find($id);
        $user = User::find($pengguna->id_user);
        if ($request->email == null) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                // 'email' => 'required',
                // 'password' => 'required',
                'no_telfon' => 'required|unique:users,no_telfon,' . $user->id,
                'alamat' => 'required',
                'role' => 'required',

            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required|unique:users,email,' . $user->id,
                // 'password' => 'required',
                'no_telfon' => 'required|unique:users,no_telfon,' . $user->id,
                'alamat' => 'required',
                'role' => 'required',

            ]);
            if ($validator->fails()) {
                $messages = $validator->errors()->all();
                Alert::error('Gagal', $messages);
                return back()->withErrors($validator)->withInput();
            }

            $user->email = $request->email ?? null;
            $user->no_telfon = $request->no_telfon;
            $user->role = $request->role;
            $user->save();
            $pengguna->nama = $request->nama;
            $pengguna->alamat = $request->alamat;
            // $pengguna->role = $request->level;
            $pengguna->save();
            Alert::success('Success Title', 'Success Message');

            return redirect()->route('karyawan');
        }
    }
}
