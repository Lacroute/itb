<?php
class Admin_controller{

  function __construct()
  {
     
  }
  
  function dashboard(){
    
    F3::set('location',Admin::instance()->getAllLocations());
    echo Views::instance()->render('admin/travels.html');
    
    /*$model=new Admin();
    $location=$model->getAllLocation();
    F3::set('location',$location);
    $view=new Views();
    echo $view->render('admin/travels.html');*/
    
    
    
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