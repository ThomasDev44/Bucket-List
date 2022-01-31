<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\AnimauxRepository;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function list(EntityManagerInterface $entityManager, AnimauxRepository $animauxRepository, WishRepository $wishRepository): Response
    {
       $AllWishes =$wishRepository ->findALlGroupByDate();
        return $this->render('wish/index.html.twig',
            compact( "AllWishes"),

        );
    }

    #[Route('/form', name: 'form')]
    public function form(EntityManagerInterface $entityManager, Request $request):Response
    {
        $wish = new Wish();
        $formWishes = $this->createForm(WishType::class, $wish);

        $formWishes->handleRequest($request);
        if (
            $formWishes->isSubmitted()
            &&
            $formWishes->isValid()
        ) {
            $entityManager->persist($wish);
            $entityManager->flush();
            $this->addFlash('success', 'Le formulaire a bien été soumis');
            return $this->redirectToRoute('wish_detail',['id' => $wish->getId()]);
        }
        return $this->render('wish/form.html.twig',
            ["formWishes" => $formWishes->createView()]
        );
    }
    #[Route('/detail/{id}', name: 'detail')]
    public function detail(Wish $wish): Response
    {


       //$theWish = $wishRepository ->findOneBy(["id" => $id], []);
            return $this->render('wish/detail.html.twig', [
                'theWish' => $wish,
            ]);
    }

}
