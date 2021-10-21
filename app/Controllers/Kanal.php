<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KanalModel;
use App\Models\DataKanalModel;
use App\Models\UniversalModel;

class Kanal extends BaseController
{
    public function __construct()
	{
        $this->kanal = new KanalModel();
        $this->datakanal = new DataKanalModel();
        $this->universal = new UniversalModel();
		$this->session = session();
	}

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }
        $data = [];
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        $data['kanal'] = $this->kanal->findAll();
        echo view('panel/page/v_kanal.php',$data);
    }

    public function card($id)
    {   
        $data = [];
        $data['id'] = $id;
        $data['data'] = ['nama'=>'','keterangan'=>'','status'=>false];
        $data['kanal_data'] = [];
        if($id != 0){
            $data['data'] = $this->kanal->find($id);
            $data['kanal_data'] = $this->datakanal->where('id_kanal',$id)->findAll();
        }
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_kanal_card.php',$data);
    }

    public function view($id)
    {
        $data['data'] = $this->kanal->find($id);
        $db      = \Config\Database::connect();

        $data['kanal_data'] = $db->query("SELECT * FROM kanal_data WHERE id_kanal='{$id}' AND status='1'")->getResultArray();
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_kanal_view.php',$data);
    }

    public function delete($id)
    {
        $form = $this->request->getVar('from');
        $this->kanal->delete($id);
        if($form == 'list'){
            return redirect()->to(base_url().'/panel/kanal');    
        }
        return redirect()->to(base_url().'/panel/kanal/card/0');
    }

    public function save($id)
    {
        $nama = $this->request->getVar('nama');
        $keterangan = $this->request->getVar('keterangan');
        $status = false;
        if($this->request->getVar('status') == "on"){
            $status = true;
        }
        $data = [
            'nama' => $nama,
            'keterangan' => $keterangan,
            'status' => $status,
        ];
        if($id == 0)
        {
            $this->kanal->insert($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url().'/panel/kanal/card/'.$this->kanal->insertID());
        }
        $this->kanal->update($id,$data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url().'/panel/kanal/card/'.$id);
    }
}
