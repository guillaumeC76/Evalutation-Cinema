<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Categorie;
use App\Form\CategorieType;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($categorie);
            $em->flush();
        }

        return $this->render('categorie/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
