<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="main", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Hi! This is the Product controller for ArtesaanZ!',
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
                'artesaani'=>$product->getArtesaani(),
                'kuvaus'=>$product->getKuvaus(),
                'hinta'=>$product->getHinta(),
                'kategoria'=>$product->getKategoria(),
                'id'=>$product->getId()
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
        $newProduct->setArtesaani($data["artesaani"]);
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
            throw $this->createNotFoundException('Eipä löydy tuotetta mokomalla tunnuksella, ' . $id);
        } else {
            return $this->json([
                'id'=> $product->getId(),
                'nimi'=> $product->getNimi(),
                'kuva'=> $product->getKuva(),
                'kuvaus'=> $product->getKuvaus(),
                'hinta'=> $product->getHinta(),
                'artesaani'=> $product->getArtesaani(),
                'kategoria'=> $product->getKategoria()
            ]);
        }
    }
    /**
     * @Route("/product/remove/{id}", name="remove_a_product")
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
                    'message'=>'Poistettiin tuote jonka id ' . $id
                ]);
            }
    }
    /**
     * @Route("/product/editnimi/{id}/{nimi}", name="edit_a_nimi")
     */
    public function muokkaaNimi($id, $nimi)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Ei tuotetta jonka id = ' . $id
            );
        } else {
            $product->setNimi($nimi);

            $entityManager->flush();

            return $this->json([
                'message' => 'Edited product with id' . $id
            ]);
        }

    }
    /**
     * @Route("/product/editkuvaus/{id}/{kuvaus}")
     */
    public function muokkaaKuvaus($id, $kuvaus)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Ei tuotetta jonka id = ' . $id
            );
        } else {
            $product->setKuvaus($kuvaus);

            $entityManager->flush();

            return $this->json([
                'message' => 'Edited product with id' . $id
            ]);
        }

    }
    /**
     * @Route("/product/editkategoria/{id}/{kategoria}")
     */
    public function muokkaaKategoria($id, $kategoria)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Ei tuotetta jonka id = ' . $id
            );
        } else {
            $product->setKategoria($kategoria);

            $entityManager->flush();

            return $this->json([
                'message' => 'Edited product with id' . $id
            ]);
        }

    }

    /**
     * @Route("/product/edithinta/{id}/{hinta}")
     */
    public function muokkaaHinta($id, $hinta)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Ei tuotetta jonka id = ' . $id
            );
        } else {
            $product->setHinta($hinta);

            $entityManager->flush();

            return $this->json([
                'message' => 'Edited product with id' . $id
            ]);
        }
    }

    /**
     * @Route("/product/editartesaani/{id}/{artesaani}", name="edit_a_artesaani")
     */
    public function muokkaaArtesaani($id, $artesaani)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Ei tuotetta jonka id = ' . $id
            );
        } else {
            $product->setArtesaani($artesaani);

            $entityManager->flush();

            return $this->json([
                'message' => 'Edited product with id' . $id
            ]);
        }

    }
    /**
     * @Route("/product/editkuva/{id}/{kuva}", name="edit_a_kuva")
     */
    public function muokkaaKuva($id, $kuva)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Ei tuotetta jonka id = ' . $id
            );
        } else {
            $product->setKuva($kuva);

            $entityManager->flush();

            return $this->json([
                'message' => 'Edited product with id' . $id
            ]);
        }

    }
}
