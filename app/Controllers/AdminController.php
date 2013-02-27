<?php
class AdminController{

  function __construct()
  {
     
  }
    
  function beforeroute(){
      $id = F3::get('SESSION.idUser'); 
      if(!isset($id)){
          F3::reroute('/login');
      }
  }


  function dashboard(){
    F3::set('title', 'Dashboard');

    F3::set('brains',BrainModel::instance()->listBrains(F3::get('SESSION.idUser')));
    echo View::instance()->render('admin/debugajax.html');
  }
  
}
?>