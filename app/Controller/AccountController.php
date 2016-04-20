<?php
class AccountController extends AppController
{
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout	=	"login";
	}

	public function Login()
	{
		$this->loadModel("Karyawan");
		if($this->request->is('post'))
		{
			
			$this->Karyawan->set($this->request->data);
			$this->Karyawan->ValidateAdmin();
			
			if($this->Karyawan->validates())
			{
				if($this->Auth->login())
				{
					return $this->redirect($this->settings['cms_url']);
				}
				else
				{
					$this->Karyawan->validationErrors["username"]	=	"Invalid Username or Password";
				}
			}
		}
	}
	
	public function Logout()
	{
		$this->Auth->logout();
		return $this->redirect($this->settings['cms_url']);
	}
}
?>