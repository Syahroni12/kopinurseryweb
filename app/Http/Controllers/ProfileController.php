<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {

        return view('page.profile.index');
    }
    public function simpan(Request $request)
    {
        if ($request->hasFile('foto')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'no_telfon' => [
                    'required',
                    Rule::unique('users', 'no_telfon')->ignore(auth()->user()->id), // pengecualian untuk ID pengguna saat ini
                ],
                'alamat' => 'required',
                'deskripsi' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'no_telfon' => [
                    'required',
                    Rule::unique('users', 'no_telfon')->ignore(auth()->user()->id), // pengecualian untuk ID pengguna saat ini
                ],
                'alamat' => 'required',
                'deskripsi' => 'required',
            ]);
        }



        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error($messages)->flash();
            return back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail(auth()->user()->id);
        $user->no_telfon = $request->no_telfon;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }

        $user->save();



        $pengguna = Pengguna::findOrFail(auth()->user()->pengguna->id);
        $pengguna->nama = $request->nama;
        // $pengguna->no_telfon = $request->no_telfon;
        $pengguna->alamat = $request->alamat;
        $pengguna->deskripsi = $request->deskripsi;


        if ($request->hasFile('foto')) {
            if (auth()->user()->pengguna->foto != "avatar.png") {

                $file = (public_path('/foto_profil/'.auth()->user()->pengguna->foto));
                // dd($file);
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            # code...

            $fileName = time() . '.' . $request->file('foto')->getClientOriginalExtension(); //mengambil ekstensi file

            $request->file('foto')->move(public_path() . '/foto_profil', $fileName);

            $pengguna->foto = $fileName;
        } //mengupload file ke public/produk
        $pengguna->save();
        Alert::success('Success', 'Profile Berhasil di ubah');
        return redirect()->route('profile');
    }
}
