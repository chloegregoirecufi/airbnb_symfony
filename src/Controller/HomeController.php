<?php 

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    private $annonceRepo;

    public function __construct(AnnonceRepository $annonceRepository)
    {
        //on injecte la dépendance dans le constructeur
        $this->annonceRepo = $annonceRepository;
    }
    
    #[Route("/", name: "accueil", methods:['GET'])]
    public function home(AnnonceRepository $annonceRepository)
    {  
        return $this->render("home/home.html.twig",[
            'annonces' => $annonceRepository->findAll(),

        ]); 
    }
    

    #[Route("/espaceUser", name:"espaceUser", methods:['GET', 'POST'])]
    public function espaceUser()
    {
        return $this->render("home/espaceUser.html.twig");
    }

    #[Route("/mesBiens/{id}", name: "mes_biens", methods:['GET'])]
    public function mesBiens(int $id, AnnonceRepository $annonceRepository)
    {
        $annonces = $annonceRepository->findMesBiens($id);
        return $this->render("home/mesBiens.html.twig", [
            "annonces"=> $annonces,
        ]);
    }


}