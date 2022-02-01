<?php
namespace App\Classe;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Card 
{
    private $session;

    public function __construct(SessionInterface $session )
    {
        $this->session = $session;
    }

   public function ajouter($id){
       $card = $this->session->get('card',[]);
       if(!empty($card[$id])){
           $card[$id]++;
       }else{
           $card = 1;
       }
       $this->session->set('card',$card);

   }

   public Function get(){
       return $this->session->get('card');
   }
   
   public Function remove(){
       return $this->session->remove('card');
   }

}
?>