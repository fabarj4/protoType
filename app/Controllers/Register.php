<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\RegisterwizardModel;
use App\Models\SetupModel;
use App\Models\UserModel;

class Register extends BaseController
{
    public function __construct()
	{
        $this->member = new MemberModel();
		$this->rm = new RegisterwizardModel();
        $this->setup = new SetupModel();
		$this->user = new UserModel();
		$this->session = session();
	}
    
    public function index()
    {
        echo view('v_register.php');
    }

    public function process()
    {
        $nama = $this->request->getVar('nama');
        $noHp = $this->request->getVar('no_hp');
        $email = $this->request->getVar('email');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $passwordConfrim = $this->request->getVar('password_confrim');
    
        if($password != $passwordConfrim){
            session()->setFlashdata('error', 'Password Konfirmasi tidak sama dengan password');
            return redirect()->to(base_url().'/register');
        }

        $dataMember = [
            'nama' => $nama,
            'no_hp' => $noHp,
            'email' => $email,
            'exp' => date("Y-m-d"),
        ];
        $this->member->insert($dataMember);

        $memberID = $this->member->insertID();

        $dataUser = [
            'username' => $username,
            'password' => $password,
            'status' => 'created',
            'source_id' => $memberID,
            'source_table' => 'member',
            'role' => 'user',
        ];
        $this->user->insert($dataUser);

        $registerWizard = [
            'id_member' => $memberID,
            'status' => 'Menunggu Pembayaran',
        ];
        $this->rm->insert($registerWizard);
        
        return redirect()->to(base_url().'/register/success/'.$this->rm->insertID());
    }

    public function success($id)
    {
        $data = [];
        $wizard = $this->rm->find($id);
        $data['wizard'] = $wizard;
        $setup = $this->setup->find(1);
        $setup['harga'] = "Rp " . number_format($setup['harga'],2,',','.');
        $data['setup'] = $setup;
        echo view('v_register_success.php',$data);
    }

    public function upload($id)
    {
        $file = $this->request->getFile('berkas');
        $fileName = $file->getRandomName();
        $data = [
            'bukti_pembayaran' => $fileName,
            'status' => 'Proses',
        ];
        $this->rm->update($id,$data);
        $file->move('uploads/bukti_pembayaran/',$fileName);
        session()->setFlashdata('success', 'Berkas Berhasil diupload');
        return redirect()->to(base_url().'/register/success/'.$id);
    }
}
