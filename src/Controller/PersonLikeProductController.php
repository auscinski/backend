<?php

namespace App\Controller;

use App\Entity\PersonLikeProduct;
use App\Form\PersonLikeProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/like')]
class PersonLikeProductController extends AbstractController
{
    #[Route('/', name: 'person_like_product', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $query_person = $request->query->get('query_person',null);
        $query_product = $request->query->get('query_product',null);

        $personLikeProducts = $this->getDoctrine()->getRepository(PersonLikeProduct::class)
            ->getSearchClasses( $query_person, $query_product );

        return $this->render('person_like_product/index.html.twig', [
            'person_like_products' => $personLikeProducts,
        ]);
    }

    #[Route('/new', name: 'person_like_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $personLikeProduct = new PersonLikeProduct();
        $form = $this->createForm(PersonLikeProductType::class, $personLikeProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personLikeProduct);
            $entityManager->flush();

            return $this->redirectToRoute('person_like_product');
        }

        return $this->render('person_like_product/new.html.twig', [
            'person_like_product' => $personLikeProduct,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/person/{person_id}/product/{product_id}', name: 'person_like_product_show', methods: ['GET'])]
    public function show(Request $request): Response
    {
        $person_id = $request->attributes->get('person_id');
        $product_id = $request->attributes->get('product_id');

        $personLikeProduct = $this->getDoctrine()
            ->getRepository(PersonLikeProduct::class)
            ->findOneBy(array('person' => $person_id, 'product' => $product_id));

        return $this->render('person_like_product/show.html.twig', [
            'person_like_product' => $personLikeProduct,
        ]);
    }

    #[Route('/person/{person_id}/product/{product_id}/edit', name: 'person_like_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request): Response
    {
        $person_id = $request->attributes->get('person_id');
        $product_id = $request->attributes->get('product_id');

        $personLikeProduct = $this->getDoctrine()
            ->getRepository(PersonLikeProduct::class)
            ->findOneBy(array('person' => $person_id, 'product' => $product_id));

        $form = $this->createForm(PersonLikeProductType::class, $personLikeProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person_like_product');
        }

        return $this->render('person_like_product/edit.html.twig', [
            'person_like_product' => $personLikeProduct,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/person/{person_id}/product/{product_id}', name: 'person_like_product_delete', methods: ['DELETE'])]
    public function delete(Request $request, PersonLikeProduct $personLikeProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personLikeProduct->getProduct(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personLikeProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('person_like_product');
    }
}
