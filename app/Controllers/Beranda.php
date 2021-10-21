<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Beranda extends BaseController
{
    public function __construct()
	{
		$this->session = session();
	}

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }
        echo view('v_beranda.php');
    }
}
