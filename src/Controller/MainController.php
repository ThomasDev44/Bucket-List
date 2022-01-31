<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Form\AnimauxType;
use App\Repository\AnimauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route ('/home', name: 'main_')]
class MainController extends AbstractController
{


    #[Route ('/page2', name: 'page2')]
    public function page2(Request $request, EntityManagerInterface $entityManager, AnimauxRepository $animauxRepository): Response
    {
        /*$zebre = new Animaux();
        $zebre ->setNom("Michel");
        $entityManager->persist($zebre);
        $entityManager->flush();*/
        $animaux = new Animaux();
        $monFormulaire = $this->createForm(AnimauxType::class, $animaux);

        $monFormulaire->handleRequest($request);
        if(
            $monFormulaire->isSubmitted()
            &&
            $monFormulaire->isValid()
        )
        {
            $entityManager->persist($animaux);
            $entityManager->flush();
            $this->addFlash('bravo', 'Le formulaire a bien été soumis');
            return $this->redirectToRoute('main_index');
        }

        return $this->render('main/page2.html.twig',
        ["monFormulaire" => $monFormulaire->createView()]
        );
//        return $this->renderForm('main/page2.html.twig', compact("monFormulaire"));
    }

    #[Route ('/About_us', name: 'aboutus')]
    public function aboutus(): Response
    {
        return $this->render('main/aboutus.html.twig', [

        ]);
    }

    #[Route ('/{id}', name: 'index')]
    public function home($id = 0): Response
    {
        return $this->render('main/index.html.twig', [
        ]);
    }


}
