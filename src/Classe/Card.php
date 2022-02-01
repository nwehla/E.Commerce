<?php
namespace App\Classe;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Card{

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    


public function ajouter($id){
    $card = $this->session->get("card",[]);
    if(!empty($card[$id])){
        $card[$id]++;
    }else{
        $card[$id]=1;
    }
    $this->session->set('card',$card);
    // $this->session->set('card',[
    //    [
    //     "id"=> $id,
    //     "quantité"=>1,
    //    ] 
    // ]);
}
public function get(){
    return$this->session->get('card');
}

public function remove(){
    return$this->session->remove('card');
}
}
?>