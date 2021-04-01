<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function index(UserRepository $UserRepository ): Response
    {
        $users = $UserRepository->findAll();


        return $this->render('admin/user.html.twig', [
            'users' =>  $users ,

        ]);
    }

    /**
     * @Route("/admin/users/create", name="user_create")
     */
    public function creatUser(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('admin_users');
            
       }

        return $this->render('admin/userForm.html.twig',[
            'userForm' => $form->createView()

        ]);

    }

    
     /**
     * @Route("/admin/users/update-{id}", name="user_update")
     */
    public function updateUser(UserRepository $UserRepository , $id, Request $request,UserPasswordEncoderInterface $passwordEncoder ){
        
        $user = $UserRepository->find($id);
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if($form->get('plainPassword')->getData() !== null) {

                    $user->setPassword(
                        $passwordEncoder->encodePassword(
                            $user,
                            $form->get('plainPassword')->getData()
                        )
                    );
                }
             $manager = $this->getDoctrine()->getManager();
             $manager->persist($user);
             $manager->flush();
        }
        
        return $this->render('admin/userForm.html.twig',[
            'userForm' => $form->createView()
        ]);
    }

     /**
     * @Route("/admin/users/delete-{id}", name="user_delete")
     */
    public function deleteUser(UserRepository $UserRepository ,$id){
        $user = $UserRepository->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($user);
        $manager->flush();
         return $this->redirectToRoute('admin_users');
    }
}
