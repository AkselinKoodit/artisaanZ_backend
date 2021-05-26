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
    public function addProduct(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(),true);
        $newProduct = new Product();
        $newProduct->setNimi($data["nimi"]);
        $newProduct->setArtisaani($data["artisaani"]);
        $newProduct->setHinta($data["hinta"]);
        $newProduct->setKategoria($data["kategoria"]);
        $newProduct->setKuva($data["kuva"]);
        $newProduct->setKuvaus($data["kuvaus"]);

        $entityManager->persist($newProduct);
        $entityManager->flush();

        return new Response('adding new product...' . $newProduct->getId());
    }
    /**
     * @Route("/product/find/{id}", name="get-a-product", methods={"GET"})
     */
    public function findProduct($id, Request $request) {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if(!$product) {
            throw $this->createNotFoundException('Ei mokomaa tuotetta tuolla tunnuksella ' . $id);
        } else {
            return $this->json([
                'id'=> $product->getId(),
                'nimi'=> $product->getNimi(),
                'kuva'=> $product->getKuva(),
                'kuvaus'=> $product->getKuvaus(),
                'hinta'=> $product->getHinta(),
                'artisaani'=> $product->getArtisaani(),
                'kategoria'=> $product->getKategoria()

            ]);
        }
    }
    /**
     * @Route("/product/remove/{id}", name="remove_a_recipe")
     */
    public function removeProduct($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
            if(!$product) {
                throw $this->createNotFoundException('Ei löyvy tuotetta tuolla tunnuksella ' . $id);
            } else {
                $entityManager->remove($product);
                $entityManager->flush();

                return $this->json([
                    'message'=>'Poistettiin resepti jonka id ' . $id
                ]);
            }
    }
}
