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
  
  function create(){
    switch(F3::get('VERB')){
      case 'GET':
        echo Views::instance()->render('admin/travel.html');
      break;
      case 'POST':
        $check=array('title'=>'required','content'=>'required','lat'=>'required');
        $error=Datas::instance()->check(F3::get('POST'),$check);
        if($error){
          F3::set('errorMsg',$error);
          echo Views::instance()->render('admin/travel.html');
          return;
        }
        Admin::instance()->create();
        F3::reroute('/admin/dashboard');
        
      break;
    }
  }
  
  function edit(){
     switch(F3::get('VERB')){
       case 'GET':
         $id=F3::get('PARAMS.id');
         $location=Admin::instance()->getLocation($id);
         F3::set('location',$location);
         $pictures=Admin::instance()->getPictures($location->id);
         F3::set('pictures',$pictures);
         echo Views::instance()->render('admin/travel.html');
       break;
       case 'POST':
         $id=F3::get('PARAMS.id');
         Admin::instance()->update($id);
         F3::reroute('/admin/dashboard');
       break;
     }
  }
  
}
?>