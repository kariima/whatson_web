<?php

namespace App\Controller;

use App\Entity\Place;
use App\Form\PlaceType;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController extends AbstractController
{
    /**
     * @Route("/place", name="place")
     */
    public function index(PlaceRepository $placeRepository)
    {
        return $this->render('place/index.html.twig', [
            'places' => $placeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/place/new", name = "place_new", methods = {"GET", "POST"})
     */

    public function new(Request $request) : Response {
        
        $places = new Place();
        $form = $this->createForm(PlaceType::class, $places);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($places);
            $em->flush();

            return $this->redirectToRoute('place');
        }

        return $this->render('place/new.html.twig', [
            "places" => $places,
            "form" => $form->createView(),
        ]);

    }
}
