<?php
class RefController{
  
  private $view;
  
  function __construct()
  {
    $this->view=new View;
  }
  function userRef(){
    echo $this->view->render('userref.html');
  }
  
  
}
?>