<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customer", name = "customer")
     */

    public function index(CustomerRepository $customerRepository) {
        return $this->render('customer/index.html.twig', [
            'customers' => $customerRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name = "customer_new", methods = {"GET", "POST"})
     */

    public function new(Request $request): Response {
        $customers = new Customer();
        $form = $this->createForm(CustomerType::class, $customers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customers);
            $em->flush();

            return $this->redirectToRoute('customer');
        }

        return $this->render('customer/new.html.twig', [
            "customers" => $customers,
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name = "customer_show", methods = {"GET"})
     */

    public function show(Customer $customers) : Response {
        return $this->render('customer/show.html.twig', [
            'customers' => $customers,
        ]);
    }

    /**
     * @Route("/edit/{id}", name = "customer_edit", methods = {"GET", "POST"})
     */

    public function edit(Request $request, Customer $customers) : Response {

        $form = $this->createForm(CustomerType::class, $customers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer');
        }

        return $this->render('customer/edit.html.twig', [
            "customers" => $customers,
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name = "customer_delete", methods = {"DELETE"})
     */

    public function delete(Request $request, Customer $customers) : Response {

        if ($this->isCsrfTokenValid('delete' . $customers->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customers);
            $entityManager->flush();

            return $this->redirectToRoute('customer');
        }

        return $this->render('customer/index.html.twig', [
            "customers" => $customers,
        ]);
    }

    
}
