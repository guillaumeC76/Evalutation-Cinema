<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Film;
use App\Form\FilmType;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($film);
            $em->flush();
        }
        return $this->render('film/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
