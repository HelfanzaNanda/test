<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    public function rules($id)
    {
        $id ? ',contact_email,'.$id : '';
        return [
            'bank_name' => 'required|min:3',
            'logo' => 'file|image|mimes:jpeg,bmp,png|max:2048|required',
            'contact_email' => 'required|email|unique:banks'.$id
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter',
            'min' => ':attribute minimal :min karakter',
            'email' => ':attribute harus bertipe email',
            'unique' => ':attribute sudah di tambahkan',
            'image' => ':attribute harus bertipe gambar',
            'mimes' => ':attribute harus berekstensi :mimes'
        ];
    }

    public function translates()
    {
        return [
            'bank_name' => 'nama bank',
            'contact_email' => 'email'
        ];
    }

    public function index()
    {
        $datas = Bank::all();
        return view('pages.bank.index', compact('datas'));
    }

    public function create()
    {
        return view('pages.bank.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules(null), $this->messages(), $this->translates());

        $logo = $request->file('logo');
        $filename = date('Y-m-d h:i:s') . '.' . $logo->getClientOriginalExtension();
        $filepath = 'test/' . $filename;
        Storage::disk('s3')->put($filepath, file_get_contents($logo));

        $bank = new Bank();
        $bank->bank_name = $request->bank_name;
        $bank->logo = Storage::disk('s3')->url($filepath, $filename);
        $bank->contact_email = $request->contact_email;
        $bank->save();

        Alert::success('berhasil', 'Berhasil Menambahkan Data');
        return redirect()->route('bank.index');
    }

    public function edit($id)
    {
        $data = Bank::findOrFail($id);
        return view('pages.bank.edit', compact('data'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules($id), $this->messages(), $this->translates());

        $bank = Bank::findOrFail($id);
        $logo = $request->file('logo');
        $filename = date('Y-m-d h:i:s') . '.' . $logo->getClientOriginalExtension();
        $filepath = 'test/' . $filename;
        Storage::disk('s3')->put($filepath, file_get_contents($logo));

        
        $bank->bank_name = $request->bank_name;
        $bank->logo = Storage::disk('s3')->url($filepath, $filename);
        $bank->contact_email = $request->contact_email;
        $bank->update();

        Alert::success('berhasil', 'Berhasil Mengupdate Data');
        return redirect()->route('bank.index');
    }

    public function destroy($id)
    {
        Bank::findOrFail($id)->delete();
        return response()->json(['status' => true]);
    }
}