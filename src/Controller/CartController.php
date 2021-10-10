<?php

namespace App\Controller;

use App\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to Cart controller!',
            'path' => 'src/Controller/CartController.php',
        ]);
    }

    /**
     * @Route("/cart/all", name="get_cart_content", methods={"GET"})
     */
    public function getCart(): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findAll();
        $response = [];
        foreach($cart as $cartItem) {
            $response[] = array(
                'id'=>$cartItem->getId(),
                'nimi'=>$cartItem->getNimi(),
                'hinta'=>$cartItem->getHinta(),
                'qty'=>$cartItem->getQty(),
                'kategoria'=>$cartItem->getKategoria(),
                'artesaani'=>$cartItem->getArtesaani()
            );
        }
        return $this->json($response);
    }

    /**
     * @Route("/cart/add", name="add_new_cartItem", methods={"POST"})
     */
    public function addCartItem(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        $newCartItem = new Cart();
        $newCartItem->setNimi($data["nimi"]);
        $newCartItem->setHinta($data["hinta"]);
        $newCartItem->setQty($data["qty"]);
        $newCartItem->setKategoria($data["kategoria"]);
        $newCartItem->setArtesaani($data["artesaani"]);

        $entityManager->persist($newCartItem);
        $entityManager->flush();

        return new Response('added new item to cart with id ' . $newCartItem->getId());
    }

    /**
     * @Route("/cart/remove/{id}", name="remove_item", methods={"DELETE"})
     */
    public function removeItem($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $cartItem = $this->getDoctrine()->getRepository(Cart::class)->find($id);
        if(!$cartItem) {
            throw $this->createNotFoundException('Ei löyvy tuotetta tuolla tunnuksella ' . $id);
        } else {
            $entityManager->remove($cartItem);
            $entityManager->flush();

            return $this->json([
                'message'=>'Poistettiin tuote jonka id ' . $id
            ]);
        }
    }
}
