<?php
namespace App\Classe;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class Card {

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function ajouter($id){

        $this->session->set('card',[
            ['id'=>$id,
            'quantite'=>1
            ]
        ]);
    }

    public function remove()
    {
        return $this->session->remove('card');
    }
    public function get()
    {
        return $this->session->get('card');
    }

}
?>