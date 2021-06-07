<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Morjensta pöytään! Tässäpä upouusi UserController!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    /**
     * @Route("/user/all", name="get_all_users", methods={"GET"})
     */
    public function getAllUsers() {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $response = [];
        foreach($users as $user) {
            $response[] = array(
                'id'=>$user->getId(),
                'nimi'=>$user->getNimi(),
                'esittely'=>$user->getEsittely(),
                'tuotteet'=>$user->getTuotteet(),
                'tuotteita'=>$user->getTuotteita(),
                'username'=>$user->getUsername(),
                'password'=>$user->getPassword()
            );
        }
        return $this->json($response);
    }

    /**
     * @Route("/user/add", name="add_new_user", methods={"POST"})
     */
    public function addUser(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $newUser = new User();
        $newUser->setNimi($data["nimi"]);
        $newUser->setEsittely($data["esittely"]);
        $newUser->setTuotteet($data["tuotteet"]);
        $newUser->setTuotteita($data["tuotteita"]);
        $newUser->setUsername($data["username"]);
        $newUser->setPassword($data["password"]);

        $entityManager->persist($newUser);
        $entityManager->flush();

        return new Response('Adding new user...' . $newUser->getId());
    }

    /**
     * @Route("user/remove/{id}", name="remove_user")
     */
    public function removeUser($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            if (!$user) {
                throw $this->createNotFoundException('Juu ei tommosta käyttäjää ookkaan jonka id ois ' . $id);
            } else {
                $entityManager->remove($user);
                $entityManager->flush();

                return $this->json([
                    'message'=>'Poistettiin käyttäjä tunnuksella ' . $id
                ]);
            }
    }

    /**
     * @Route("/user/find/{id}", name="find_user", methods={"GET"})
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function findUser($id, Request $request) {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Hmm tarkastappa tuo id, ei nääs mitään löydy tällä: ' . $id);
        } else {
            return $this->json([
                'id'=> $user->getId(),
                'nimi'=> $user->getNimi(),
                'esittely'=> $user->getEsittely(),
                'tuotteet'=> $user->getTuotteet(),
                'tuotteita'=>$user->getTuotteita(),
                'username'=>$user->getUsername(),
                'password'=>$user->getPassword()
            ]);
        }
    }


}
