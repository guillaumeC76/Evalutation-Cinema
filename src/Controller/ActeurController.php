<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Acteur;
use App\Form\ActeurType;

class ActeurController extends AbstractController
{
    /**
     * @Route("/acteur", name="acteur")
     */
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $acteur = new Acteur();
        $form = $this->createForm(ActeurType::class, $acteur);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($acteur);
            $em->flush();
        }

        return $this->render('acteur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
