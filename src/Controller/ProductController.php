<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }


    /**
     * @Route("/products/all", methods={"GET"})
     */
    public function getAllProducts() {
        $rootPath = $this->getParameter('kernel.project_dir');
        $products = file_get_contents($rootPath . '/Resources/products.json');
        $decodedProducts = json_decode($products, true);
        return $this->json($decodedProducts);
    }
    /**
     * @Route("/product/add", name="add_new_product")
     */
    public function addProduct(){
        $entityManager = $this->getDoctrine()->getManager();

        $newProduct = new Product();
        $newProduct->setNimi('Vehnäleipä');
        $newProduct->setArtisaani('Aksu');
        $newProduct->setHinta(8);
        $newProduct->setKategoria("ruoka");
        $newProduct->setKuva((array)'[https://cdn.valio.fi/mediafiles/6a36f3fc-3862-4dea-a19f-5a1dba8822f6/1440x1080-cms-content-default-hero)]');
        $newProduct->setKuvaus('Herkullinen vehnäleipä leivottu hapanjuureen');

        $entityManager->persist($newProduct);
        $entityManager->flush();

        return new Response('adding new product...' . $newProduct->getId());
    }
    /**
     * @Route("/product/{id}", name="get-a-product", methods={"GET"})
     */
    public function product($id, Request $request) {

        return $this->json([
            'message'=>'Requesting recipe with id'. $id,
            'page'=> $request->query->get('page')
        ]);
    }
}
