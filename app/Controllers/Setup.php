<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KanalModel;
use App\Models\SetupModel;

class Setup extends BaseController
{
    public function __construct()
	{
        $this->kanal = new KanalModel();
        $this->setup = new SetupModel();
		$this->session = session();
	}

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }
        $data = [];
        $data['data'] = $this->setup->find(1);
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_setup.php',$data);
    }


    public function save($id)
    {
        $durasi = $this->request->getVar('durasi');
        $harga = $this->request->getVar('harga');
        $rekening = $this->request->getVar('rekening');
        $an = $this->request->getVar('atas_nama');
        $data = [
            'durasi' => $durasi,
            'harga' => $harga,
            'rekening' => $rekening,
            'atas_nama' => $an,
        ];
        $this->setup->update(1,$data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url().'/panel/setup');
    }
}

