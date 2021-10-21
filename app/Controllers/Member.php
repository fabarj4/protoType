<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\SetupModel;
use App\Models\KanalModel;

class Member extends BaseController
{
    public function __construct()
	{
        $this->kanal = new KanalModel();
        $this->member = new MemberModel();
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
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        $data['member'] = $this->member->findAll();
        echo view('panel/page/v_member.php',$data);
    }

    public function card($id)
    {   
        $data = [];
        $data['id'] = $id;
        $data['data'] = ['nama' => '', 'no_hp' => '', 'email' => '', 'alamat' => '', 'foto' => '', 'status'=>false];
        if($id != 0){
            $data['data'] = $this->member->find($id);
        }
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_member_card.php',$data);
    }

    public function delete($id)
    {
        $form = $this->request->getVar('from');
        $this->member->delete($id);
        if($form == 'list'){
            return redirect()->to(base_url().'/panel/member');    
        }
        return redirect()->to(base_url().'/panel/member/card/0');
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
            $file->move('uploads/member/',$fileName);
            $data['foto'] = $fileName;
        }
        if($id == 0)
        {
            $this->member->insert($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url().'/panel/member/card/'.$this->member->insertID());
        }
        $this->member->update($id,$data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url().'/panel/member/card/'.$id);
    }

    public function exp_add($id){
        $member = $this->member->find($id);
        if($member['exp'] == "0000-00-00"){
            $member['exp'] = date('Y-m-d');
        }
        $setup = $this->setup->find('1');
        $member['exp'] = date('Y-m-d', strtotime("+".$setup['durasi']." months", strtotime($member['exp'])));

        $data = [
            'exp' => $member['exp'],
        ];
        print_r($data);
        $this->member->update($id,$data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(base_url().'/panel/member/card/'.$id);
    }
}
