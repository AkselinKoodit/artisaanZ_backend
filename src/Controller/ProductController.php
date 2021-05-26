<?php

namespace App\Controller;

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
     * @Route("/product/{id}", name="get-a-product", methods={"GET"})
     */
    public function product($id, Request $request) {
        return $this->json([
            'message'=>'Requesting recipe with id'. $id,
            'page'=> $request->query->get('page')
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
}
