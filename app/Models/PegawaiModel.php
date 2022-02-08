<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
  protected $table = 'tbl_pegawai';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nama', 'email'];

  protected $validationRules = [
    'nama' => 'required',
    'email' => 'required|valid_email'
  ];
  protected $validationMessages = [
    'nama' => [
      'required' => 'Silahkan masukkan nama'
    ],
    'email' => [
      'required' => 'Silahkan masukkan email',
      'valid_email' => 'Masukkan email yang valid'
    ]
  ];
}
