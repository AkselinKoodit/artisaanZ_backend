<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Seller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellerController extends AbstractController
{
    #[Route('/seller', name: 'seller')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Morjensta pöytään! Tässäpä upouusi SellerController!',
            'path' => 'src/Controller/SellerController.php',
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/seller/all", name="get_all_sellers", methods={"GET"})
     */

    public function getAllSellers() {
        $sellers = $this->getDoctrine()->getRepository(Seller::class)->findAll();
        $response = [];
        foreach($sellers as $seller) {
            $response[] = array(
                'id'=>$seller->getId(),
                'nimi'=>$seller->getNimi(),
                'esittely'=>$seller->getEsittely(),
//                'tuotteet'=>$seller->getTuotteet(),
//                'tuotteita'=>$seller->getTuotteita(),
                'username'=>$seller->getUsername(),
                'password'=>$seller->getPassword()
            );
        }
        return $this->json($response);
    }

    /**
     * @Route("/seller/add", name="add_new_seller", methods={"POST"})
     */
    public function addSeller(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $newSeller = new Seller();
        $newSeller->setNimi($data["nimi"]);
        $newSeller->setEsittely($data["esittely"]);
//        $newSeller->setTuotteet($data["tuotteet"]);
//        $newSeller->setTuotteita($data["tuotteita"]);
        $newSeller->setUsername($data["username"]);
        $newSeller->setPassword($data["password"]);

        $entityManager->persist($newSeller);
        $entityManager->flush();

        return new Response('Adding new seller...' . $newSeller->getId());
    }

    /**
     * @Route("seller/remove/{id}", name="remove_seller")
     */
    public function removeSeller($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $seller = $this->getDoctrine()->getRepository(Seller::class)->find($id);
            if (!$seller) {
                throw $this->createNotFoundException('Juu ei tommosta käyttäjää ookkaan jonka id ois ' . $id);
            } else {
                $entityManager->remove($seller);
                $entityManager->flush();

                return $this->json([
                    'message'=>'Poistettiin käyttäjä tunnuksella ' . $id
                ]);
            }
    }

    /**
     * @Route("/seller/find/{id}", name="find_seller", methods={"GET"})
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function findSeller($id, Request $request) {
        $seller = $this->getDoctrine()->getRepository(Seller::class)->find($id);
        if (!$seller) {
            throw $this->createNotFoundException('Hmm tarkistappa tuo id, ei nääs mitään löydy tällä: ' . $id);
        } else {
            return $this->json([
                'id'=> $seller->getId(),
                'nimi'=> $seller->getNimi(),
                'esittely'=> $seller->getEsittely(),
//                'tuotteet'=> $seller->getTuotteet(),
//                'tuotteita'=>$seller->getTuotteita(),
                'username'=>$seller->getUsername(),
                'password'=>$seller->getPassword()
            ]);
        }
    }



}
