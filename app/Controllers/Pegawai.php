<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use CodeIgniter\API\ResponseTrait;


class Pegawai extends BaseController
{
  use ResponseTrait;

  public function __construct()
  {
    $this->model = new PegawaiModel();
  }

  public function index()
  {
    $data = $this->model->orderBy('nama', 'asc')->findAll();

    return $this->respond($data, 200);
  }

  public function show($id = null)
  {
    $data = $this->model->where('id', $id)->findAll();

    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound("Data dengan id $id tidak ditemukan");
    }
  }

  public function create()
  {
    // $data = [
    //   'nama' => $this->request->getVar('nama'),
    //   'email' => $this->request->getVar('email'),
    // ];

    $data = $this->request->getPost();

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $response = [
      'status' => 200,
      'error' => null,
      'message' => [
        'success' => 'Data berhasil di input'
      ]
    ];

    return $this->respond($response);
  }

  public function update($id = null)
  {
    $data = $this->request->getRawInput();
    $data['id'] = $id;

    $isExist = $this->model->where('id', $id)->findAll();
    if (!$isExist) {
      return $this->failNotFound("Data dengan id $id tidak ditemukan.");
    }

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $response = [
      'status' => 200,
      'error' => null,
      'message' => [
        'success' => 'Data berhasil di update'
      ]
    ];

    return $this->respond($response);
  }

  public function delete($id = null)
  {
    $data = $this->model->where('id', $id)->findAll();

    if ($data) {
      $this->model->delete($id);
      $response = [
        'status' => 200,
        'error' => null,
        'message' => [
          'success' => 'Data berhasil di hapus'
        ]
      ];
      return $this->respondDeleted($response);
    } else {
      return $this->failNotFound("Data tidak ditemukan");
    }
  }
}
