<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StaffModel;
use App\Models\KanalModel;

class Staff extends BaseController
{
    public function __construct()
	{
        $this->kanal = new KanalModel();
        $this->staff = new StaffModel();
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
        $data['staff'] = $this->staff->findAll();
        echo view('panel/page/v_staff.php',$data);
    }

    public function card($id)
    {   
        $data = [];
        $data['id'] = $id;
        $data['data'] = ['nama' => '', 'no_hp' => '', 'email' => '', 'alamat' => '', 'foto' => '', 'status'=>false];
        if($id != 0){
            $data['data'] = $this->staff->find($id);
        }
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_staff_card.php',$data);
    }

    public function delete($id)
    {
        $form = $this->request->getVar('from');
        $this->staff->delete($id);
        if($form == 'list'){
            return redirect()->to(base_url().'/panel/staff');    
        }
        return redirect()->to(base_url().'/panel/staff/card/0');
    }

    public function save($id)
    {
        $file = $this->request->getFile('berkas');
        $fileName = $file->getRandomName();
        $nama = $this->request->getVar('nama');
        $no_hp = $this->request->getVar('no_hp');
        $email = $this->request->getVar('email');
        $alamat = $this->request->getVar('alamat');

        $status = false;
        if($this->request->getVar('status') == "on"){
            $status = true;
        }
        $data = [
            'nama' => $nama,
            'no_hp' => $no_hp, 
            'email' => $email, 
            'alamat'=> $alamat,
            'status' => $status,
        ];
        if ($file->isValid() && ! $file->hasMoved()) {
            $file->move('uploads/staff/',$fileName);
            $data['foto'] = $fileName;
        }
        if($id == 0)
        {
            $this->staff->insert($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url().'/panel/staff/card/'.$this->staff->insertID());
        }
        $this->staff->update($id,$data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url().'/panel/staff/card/'.$id);
    }
}
