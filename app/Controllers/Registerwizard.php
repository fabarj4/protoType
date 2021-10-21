<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegisterwizardModel;
use App\Models\KanalModel;
use App\Models\MemberModel;
use App\Models\SetupModel;

class Registerwizard extends BaseController
{
    public function __construct()
	{
        $this->kanal = new KanalModel();
        $this->member = new MemberModel();
        $this->setup = new SetupModel();
        $this->registerwizard = new RegisterwizardModel();
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
        $data['registerwizard'] = $this->registerwizard->findAll();
        echo view('panel/page/v_registerwizard.php',$data);
    }

    public function card($id)
    {   
        $data = [];
        $data['id'] = $id;
        $data['data'] = ['id_member'=>'','bukti_pembayaran'=>'', 'status'=>false];
        if($id != 0){
            $data['data'] = $this->registerwizard->find($id);
            $data['data_member'] = $this->member->find($data['data']['id_member']);
        }
        $data['menu_kanal'] = $this->kanal->where('status',1)->findAll();
        echo view('panel/page/v_registerwizard_card.php',$data);
    }

    public function delete($id)
    {
        $form = $this->request->getVar('from');
        $this->registerwizard->delete($id);
        if($form == 'list'){
            return redirect()->to(base_url().'/panel/registerwizard');    
        }
        return redirect()->to(base_url().'/panel/registerwizard/card/0');
    }

    public function save($id)
    {
        
        $id_member = $this->request->getVar('id_member');
        $status = $this->request->getVar('status');
        $data = [
            'id_member' => $id_member, 
            'status' => $status,
        ];
        $this->registerwizard->update($id,$data);

        $member = $this->member->find($id_member);
        if($status == "OK"){
            if($member['exp'] == "0000-00-00"){
                $member['exp'] = date('Y-m-d');
            }
        }
        $setup = $this->setup->find('1');
        $member['exp'] = date('Y-m-d', strtotime("+".$setup['durasi']." months", strtotime($member['exp'])));

        $data = [
            'exp' => $member['exp'],
        ];
        $this->member->update($id_member,$data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url().'/panel/registerwizard/card/'.$id);
    }
}
