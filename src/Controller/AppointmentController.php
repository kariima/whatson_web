<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentType;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/appointment", name="appointment")
     */
    public function index(AppointmentRepository $appointmentRepository)
    {

        return $this->render('appointment/index.html.twig', [
            'appointments' => $appointmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/appointment/new", name = "appointment_new", methods = {"GET", "POST"})
     */

    public function new(Request $request) : Response {

        $appointments = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointments);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appointments);
            $em->flush();

            return $this->redirectToRoute('appointment');
        }

        return $this->render('appointment/new.html.twig', [
            'appointments' => $appointments,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/appointment/show/{id}", name = "appointment_show", methods = {"GET"})
     */
    
    public function show(Appointment $appointments) : Response {

        $appointments->getUser();
        $appointments->getCustomer();
        $appointments->getPlace();
        return $this->render('appointment/show.html.twig', [
            'appointments'  => $appointments,
        ]);
    }

    /**
     * @Route("/appointment/edit/{id}", name = "appointment_edit", methods = {"GET", "POST"})
     */

    public function edit(Request $request, Appointment $appointments): Response
    {

        $form = $this->createForm(AppointmentType::class, $appointments);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appointment');
        }

        return $this->render('appointment/edit.html.twig', [
            "appointments" => $appointments,
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/appointment/delete/{id}", name = "appointment_delete", methods = {"DELETE"})
     */

    public function delete(Request $request, Appointment $appointments) : Response 
    {

        if($this->isCsrfTokenValid('delete' . $appointments->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appointments);
            $em->flush();

            return $this->redirectToRoute('appointment');
        }

        return $this->render('appointment/index.html.twig', [
            'appointments'  =>  $appointments,
        ]);

    }
}
