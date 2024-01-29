<?php 

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\AnnonceRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
     //on déclare la propriété pour l'encodage
     private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        //on injecte la dépendance dans le constructeur
        $this->encoder = $encoder;
    }
    
    #[Route("/", name: "accueil", methods:['GET'])]
    public function home()
    {  
        return $this->render("home/home.html.twig"); 
    }
    

    #[Route("/espaceUser", name:"espaceUser", methods:['GET', 'POST'])]
    public function espaceUser()
    {
        return $this->render("home/espaceUser.html.twig");
    }

    #[Route("/mesBiens/{id}", name: "mes biens", methods:['GET'])]
    public function mesBiens(int $id, AnnonceRepository $annonceRepository)
    {
        $annonces = $annonceRepository->findMesBiens($id);
        return $this->render("home/mesBiens.html.twig", [
            "annonces"=>$annonces
        ]);
    }


}