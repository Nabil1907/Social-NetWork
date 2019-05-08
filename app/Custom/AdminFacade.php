<?php
class AdminFacade{
  protected $admin;
  public function __construct(Admin $admin){
    $this->admin = $admin;
  }
  public function createAdmin(){
    $newAdmin = $this->admin->CreateAdmin();
    $newAdmin->setAsAdmin();
  }
  
}
