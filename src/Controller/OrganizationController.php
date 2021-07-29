<?php

namespace App\Controller;

use App\Entity\Organization;
use App\Services\OrganizationService;
use App\Form\OrganizationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

class OrganizationController extends AbstractController
{
    /**
     * @Route("/organization", name="organization")
     */
    public function index(): Response
    {
        return $this->render('organization/index.html.twig', [
            'controller_name' => 'OrganizationController',
        ]);
    }
     /**
     * @Route("organization/create","organization_creation")
     */
    public function newOrganization(Request $request,OrganizationService $orgaService):Response
    {

        $orga = new Organization();
        $form = $this->createForm(OrganizationType::class,$orga);
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
            {
                $orga = $form->getData();
              
            $orgaService->addOrga($orga);
                return $this->render('organization/create_completed.html.twig',['orga'=>$orga]);
            }
        else
            return $this->render('organization/creer.html.twig',['formulaire'=>$form->createView()]);
    }
}
