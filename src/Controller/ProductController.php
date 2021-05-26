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
            'message' => 'Hi! This is the Product controller fo ArtesaanZ!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }


    /**
     * @Route("/product/all", name="get_all_products", methods={"GET"})
     */
    public function getAllProducts() {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
//        $rootPath = $this->getParameter('kernel.project_dir');
//        $products = file_get_contents($rootPath . '/Resources/products.json');
//        $decodedProducts = json_decode($products, true);
        $response=[];
        foreach($products as $product) {
            $response[] = array(
                'nimi'=>$product->getNimi(),
                'kuva'=>$product->getKuva(),
                'artisaani'=>$product->getArtisaani(),
                'kuvaus'=>$product->getKuvaus(),
                'hinta'=>$product->getHinta(),
                'kategoria'=>$product->getKategoria()
            );
        }
        return $this->json($response);
    }
    /**
     * @Route("/product/add", name="add_new_product", methods={"POST"})
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
