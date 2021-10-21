<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataKanalModel;
use App\Models\KanalModel;

class DataKanal extends BaseController
{
    public function __construct()
	{
        $this->datakanal = new DataKanalModel();
        $this->kanal = new KanalModel();
		$this->session = session();
	}

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }
        $data = [];
        $data['datakanal'] = $this->datakanal->findAll();
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_datakanal.php',$data);
    }

    public function card($id)
    {   
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }
       
        $idKanal = $this->request->getVar('id_kanal');
        $data = [];
        $data['id'] = $id;
        $data['id_kanal'] = $idKanal;
        $data['data'] = ['judul'=>'','gambar'=>'','status'=>'','caption'=>''];
        if($id != 0){
            $data['data'] = $this->datakanal->find($id);
        }
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_data_kanal_card.php',$data);
    }

    public function delete($id)
    {
        $form = $this->request->getVar('from');
        $idKanal = $this->request->getVar('id_kanal');
        $this->datakanal->delete($id);
        if($form == 'list'){
            return redirect()->to(base_url().'/panel/kanal/card/'.$idKanal);    
        }
        return redirect()->to(base_url().'/panel/datakanal/card/0?id_kanal='.$idKanal);
    }

    public function save($id)
    {
        $file = $this->request->getFile('berkas');
        $idKanal = $this->request->getVar('id_kanal');
        $judul = $this->request->getVar('judul');
        $caption = $this->request->getVar('caption');
        $fileName = $file->getRandomName();
        $status = false;
        if($this->request->getVar('status') == "on"){
            $status = true;
        }
        $data = [
            'judul' => $judul,
            'id_kanal' => $idKanal,
            'caption' => $caption,
            'status' => $status,
            // 'gambar' => $fileName,
        ];
        if ($file->isValid() && ! $file->hasMoved()) {
            $file->move('uploads/kanal_data/',$fileName);
            $data['gambar'] = $fileName;
        }
        if($id == 0)
        {
            $this->datakanal->insert($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url().'/panel/datakanal/card/'.$this->datakanal->insertID().'?id_kanal='.$idKanal);
        }
        $this->datakanal->update($id,$data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url().'/panel/datakanal/card/'.$id.'?id_kanal='.$idKanal);
    }
}

