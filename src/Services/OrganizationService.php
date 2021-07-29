<?php
namespace App\Services;

use App\Entity\Organization;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationService
{
    private $_entityManager;
    private $_listeOrgas=[];

    public function __construct(EntityManagerInterface $em)
    {
        $this->_entityManager= $em;
        $this->_listeOrgas = $this->_entityManager->getRepository(Organization::class)->findAll();
    }
    public function getList()
    {
        return $this->_listeOrgas;
    }
    public function addOrga($pOrga)
    {
        array_push($this->_listeOrgas,$pOrga);
        $this->_entityManager->persist($pOrga);
        $this->_entityManager->flush();

    }

    public function getOrga($pId)
    {
       /* $find = false;
        $hero = null;
        $i = 0; 
        while (($i < count($this->_listeHeros))&& $find == false)
        {
            if ($this->_listeHeros[$i]->getId()==$pId)
            {
                $find = true;
            $hero = $this->_listeHeros[$i];
            }
            $i++;
        }
        return  ['found'=>$find,'hero'=>$hero];*/
        $find = false;
        $orga = $this->_entityManager->getRepository(Organization::class)->find($pId);
        if (isset($orga))
            $find = true;
        return  ['found'=>$find,'orga'=>$orga];
    }
    public function delOrga($pId)
    {
        $orga = $this->getOrga($pId);
        if ($orga['found']== true)
        {
            $this->_entityManager->remove($orga['orga']);
            $this->_entityManager->flush();
        }
        
    }
}