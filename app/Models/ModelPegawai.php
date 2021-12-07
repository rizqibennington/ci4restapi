<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelPegawai extends Model{
    protected $table = "pegawai";
    protected $primarykey = "id";
    protected $allowedFields = ['foto', 'nama', 'umur', 'tanggallahir', 'email', 'password'];

    protected $validationRules = [
        'foto'          => 'max_size[foto,1024]|ext_in[foto,jpg,png]',
        'nama'          => 'required|max_length[20]',
        'umur'          => 'required|less_than_equal_to[17]|greater_than_equal_to[10]',
        'tanggallahir'  => 'required|less_than_equal_to[17]|greater_than_equal_to[10]',
        'email'         => 'required|valid_email',
        'password'      => 'required|alpha_numeric|max_length[8]'


    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama masih kosong',
            'max_length' => 'Maximum Karakter 20'
        ],
        'email' => [
            'required'      =>  'Email masih kosong',
            'valid_email'   =>  'Masukan format email yang benar!'
        ]
    ];

}


?>