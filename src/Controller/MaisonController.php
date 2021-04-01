<?php

namespace App\Controller;

use App\Entity\Maison;
use App\Form\MaisonType;
use App\Repository\MaisonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaisonController extends AbstractController
{
    /**
     * @Route("/admin/maison", name="admin_maisons")
     */
    public function index(MaisonRepository $maisonRepository): Response
    {
        $maisons = $maisonRepository->findAll();
        return $this->render('admin/maison.html.twig', [
            'maisons' => $maisons,
        ]);
    }

    /**
     * @Route("/admin/maison/create", name="maison_create")
     */

    public function createMaison(Request $request)
    {
        $maison = new Maison();
        $form = $this->createForm(MaisonType::class,$maison);
        $form->handleRequest($request); 

        if($form->isSubmitted()){
            if($form->isValid()) {
                $infoImg1 = $form['img1']->getData();
                $extensionImg1 = $infoImg1->guessExtension();
                $nomImg1 = '1-'.time().'.' .$extensionImg1;
                $infoImg1->move( $this->getParameter('dossier_photos_maisons'), $nomImg1);
                $maison->setImg1($nomImg1);          
                
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($maison);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'la maison a bien ete ajoutée '
                );
            }
            else{
                $this->addFlash(
                    'danger',
                    'un erreur est survenue lors de ajoute '
                );
            }
            return $this->redirectToRoute('admin_maisons');
        }

        return $this->render('admin/maisonForm.html.twig',[ 
            'maisonForm' => $form->createView()
        ]);


     }

     /**
     * @Route("/admin/maison/update-{id}", name="maison_update")
     */
    public function updateMaison(MaisonRepository $maisonRepository,$id, Request $request){

        $maison = $maisonRepository->find($id);

        $form = $this->createForm(MaisonType::class,$maison);
         $form->handleRequest($request); 
         if($form->isSubmitted() &&  $form->isValid()  ){
                
              $oldNomImg1 = $maison->getImg1();
              $oldCheminImg1 = $this->getParameter('dossier_photos_maisons'). '/' . $oldNomImg1 ;
              if(\file_exists($oldCheminImg1)){
                  unlink($oldCheminImg1);
              }
        
                $infoImg1 = $form['img1']->getData();
                $extensionImg1 = $infoImg1->guessExtension();
                $nomImg1 = '1-'.time().'.' .$extensionImg1;
                $infoImg1->move( $this->getParameter('dossier_photos_maisons'), $nomImg1);
                $maison->setImg1($nomImg1);          
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($maison);
                $manager->flush();

                // message de succes 
                $this->addFlash(
                    'success',
                    'la maison a bien ete modifier '
                );
                return $this->redirectToRoute('admin_maisons');

            }
            
            
            return $this->render('admin/maisonForm.html.twig',[ 
                'maisonForm' => $form->createView()
            ] ) ;    

    }

    
    /**
     * @Route("/admin/maison/delete-{id}", name="maison_delete")
     */
    public function deleteMaison( MaisonRepository $maisonRepository, $id)
    {
         
        $maison = $maisonRepository->find($id);
        
        $oldNomImg1 = $maison->getImg1();
        $oldCheminImg1 = $this->getParameter('dossier_photos_maisons'). '/' . $oldNomImg1 ;
        if(\file_exists($oldCheminImg1)){
            unlink($oldCheminImg1);
        }
        
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($maison);
        $manager->flush();

        return $this->redirectToRoute('admin_maisons');

    }
}
