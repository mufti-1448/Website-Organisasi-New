<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $primaryKey = 'id';
    public $incrementing = false;       
    protected $keyType = 'string';
    protected $fillable = ['nama', 'email', 'kontak', 'kelas', 'jabatan', 'alamat', 'foto'];

    public function notulen()
    {
        return $this->hasMany(Notulen::class, 'penulis_id');
    }
    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'penulis');
    }
    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class, 'penanggung_jawab_id');
    }
}
