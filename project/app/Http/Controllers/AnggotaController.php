<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('kelas', 'LIKE', "%{$search}%")
                    ->orWhere('jabatan', 'LIKE', "%{$search}%")
                    ->orWhere('kontak', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $anggota = $query->paginate(6);
        if (request()->is('admin/*')) {
            return view('admin.anggota.index', compact('anggota'));
        }
        return view('user.anggota.index', compact('anggota'));
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('user.anggota.show', compact('anggota'));
    }

    public function create()
    {
        $lastAnggota = DB::table('anggota')->orderBy('id', 'desc')->first();
        $nextCode = "AGT001";
        if ($lastAnggota && $lastAnggota->id) {
            $lastCode = $lastAnggota->id;
            $number = (int) substr($lastCode, 3);
            $nextNumber = $number + 1;
            $nextCode = 'AGT' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }

        return view('admin.anggota.create', compact('nextCode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'foto' => 'nullable|image|max:2048',
        ]);

        $file = $request->file('foto');
        $namaFile = null;

        if ($file) {
            $namaOrang = str_replace(' ', '_', strtolower($request->nama));
            $ekstensi  = $file->getClientOriginalExtension();
            $idLower = strtolower($request->id);
            $namaFile = time() . '_' . $idLower . '_' . $namaOrang . '.' . $ekstensi;
            $file->move(public_path('storage/uploads/anggota'), $namaFile);
        } else {
            $namaFile = null;
        }

        DB::table('anggota')->insert([
            'id' => $request->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'kontak' => $request->kontak,
            'kelas' => $request->kelas,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'foto' => $namaFile,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();
        if (!$anggota) {
            return redirect()->route('anggota.index')->with('error', 'Anggota tidak ditemukan.');
        }
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'foto' => 'nullable|image|max:2048',
        ]);

        $anggota = DB::table('anggota')->where('id', $id)->first();

        $file = $request->file('foto');
        $namaFile = $anggota->foto;

        if ($file) {
            if ($anggota->foto && file_exists(public_path('storage/uploads/anggota/' . $anggota->foto))) {
                unlink(public_path('storage/uploads/anggota/' . $anggota->foto));
            }
            $namaOrang = str_replace(' ', '_', strtolower($request->nama));
            $ekstensi  = $file->getClientOriginalExtension();
            $idLower = strtolower($id);
            $namaFile = time() . '_' . $idLower . '_' . $namaOrang . '.' . $ekstensi;
            $file->move(public_path('storage/uploads/anggota'), $namaFile);
        } else {
            $namaFile = $anggota->foto; 
        }

        DB::table('anggota')->where('id', $id)->update([
            'id' => $request->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'kontak' => $request->kontak,
            'kelas' => $request->kelas,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'foto' => $namaFile,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();
        if ($anggota && $anggota->foto) {
            $filePath = public_path('storage/uploads/anggota/' . $anggota->foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        DB::table('anggota')->where('id', $id)->delete();
        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
