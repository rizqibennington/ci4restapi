<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPegawai;
use CodeIgniter\HTTP\Request;

class Pegawai extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new ModelPegawai();
    }
    public function index()
    {
        $data = $this->model->orderBy('nama','asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if($data){
            return $this->respond($data, 200);
        }else{
            return $this->failNotFound("Data tidak ditemukan pada ID $id");
        }
    }
    public function create()
    {
        $data = [
            'foto'          => $this->request->getFile('foto'),
            'nama'          => $this->request->getVar('nama'),
            'umur'          => $this->request->getVar('umur'),
            'tanggallahir'  => $this->request->getVar('tanggallahir'),
            'email'         => $this->request->getVar('email'),
            'password'      => $this->request->getVar('password'),
        ];
        
        // $data = $this->request->getPost();
        if(!$this->model->save($data)){
            return $this->fail($this->model->errors());
        }
        else{
        $response = [
            'status'    => 201,
            'error'     => null,
            'messages'  => [
            'success'   => 'Berhasil memasukkan data pegawai'
            ]
        ];}
        return $this->respond($response);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $isExists = $this->model->where('id', $id)->findAll();
        if(!$isExists){
            return $this->failNotFound("Data dengan $id tidak ditemukan");
        }
        if(!$this->model->save($data)){//kalau ada error
            return $this->fail($this->model->errors());
        }
        $response = [
            'status'    => 201,
            'error'     => null,
            'messages'  => [
            'success'   => 'Berhasil mengubah data'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if($data){
            $this->model->delete($id);
            $response = [
                'status'    => 200,
                'error'     => null,
                'messages'  => [
                'success'   => 'Data berhasil dihapus'
                ]
                ];
                return $this->respondDeleted($response);
        }else{
            return $this->failNotFound("Data dengan $id tidak ditemukan");
        }
    }

}
