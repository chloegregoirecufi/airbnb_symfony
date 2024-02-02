<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\UserRepository;
use App\Repository\AnnonceRepository;
use App\Repository\EquipementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/annonce')]
class AnnonceController extends AbstractController
{
    #[Route('/', name: 'app_annonce_index', methods: ['GET'])]
    public function index(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {

        $annonce = new Annonce();
        //récupère l'user actuellement connecté
        $user = $security->getUser();

        if(!$user){
            return new Response("vous n'êtes pas connecté");
        }

        $annonce->setUser($user);

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if($imageFile)
            {
                //si une image est uploadée, on récupère son nom d'origine
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                //on genere un nouveau nom unique pour éviter d'ecraser des images de même nom
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                try{
                    //on déplace l'image uploadée dans le dossier public/images
                    $imageFile->move(
                        //games_images_directory est configuré dans config/services.yaml
                        $this->getParameter('annonce_images_directory'),
                        $newFilename
                    );
                }catch(FileException $e)
                {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
                }
                
                //on donne le nouveau nom pour la bdd
                $annonce->setImagePath($newFilename);
            }
            
            $annonce->setImageFile(null);
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('accueil', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }


    #[Route('/detail/{id}', name: 'app_annonce_show', methods: ['GET'])]
    public function show(Annonce $annonce): Response
    {
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_annonce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonce $annonce, EntityManagerInterface $entityManager, Security $security): Response
    {
        //sécuriser l'id du bien dans url
        $annonce_user_id = $annonce->getUser()->getId();
        if($annonce_user_id != $security->getUser()->getId()){
            throw new AccessDeniedException('Vous n\'êtes pas le bienvenu');
        } 

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('mes_biens', ['id'=>  $annonce_user_id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_annonce_delete', methods: ['GET','POST'])]
    public function delete(Request $request, Annonce $annonce, EntityManagerInterface $entityManager, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mes_biens', ['id'=> $user->getId()], Response::HTTP_SEE_OTHER);
    }
}
