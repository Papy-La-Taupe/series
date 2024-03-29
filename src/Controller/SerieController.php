<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/series', name: 'serie_')]
class SerieController extends AbstractController
{
    #[Route("", name: 'list')]
    public function list(SerieRepository $serieRepository): Response
    {
        //mieux que simplement findAll,permet de sur-trier
        $series = $serieRepository->findBestSeries();

        return $this->render('serie/list.html.twig', [
            "series"=> $series,
        ]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);
        //todo: aller chercher la série en BDD
        return $this->render('serie/details.html.twig', [
            "serie"=>$serie,
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response{
        $serie = new Serie();
        //je set la date de création ici car elle n'est pas dans le formulaire mais est required
        $serie->setDateCreated(new \DateTime());
        $serieForm = $this ->createForm(SerieType::class, $serie);

        $serieForm->handleRequest($request);
        if($serieForm->isSubmitted() && $serieForm->isValid()){

            $entityManager->persist($serie);
            $entityManager->flush();

            $this->addFlash('success', 'Série ajoutée');
            //je revens vers serie-details, et je dois fournir un id
            //heureusement, dès que j'ai flush, l'entité $serie a été mis a jour avec son id
            return $this->redirectToRoute('serie_details', [
                'id' =>$serie->getId()]);
        }

        return $this->render('serie/create.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }
    #[Route('/demo', name: 'demo')]
    public function demo(EntityManagerInterface $entityManager): Response
    {
        //créer instance entité
        $serie = new Serie();
        //hydrater totes les proprietes
        $serie->setName('coucou');
        $serie->setBackdrop('ggg');
        $serie->setPoster('rdgdf');
        $serie->setGenres('rgre');
        $serie->setSynopsis('refg');
        $serie->setVote('4.7');
        $serie->setDateCreated(new \DateTime());
        $serie->setFirstAirDate(new \DateTime("- 1 year"));
        $serie->setLastAirDate(new \DateTime("-6 months"));
        $serie->setPopularity('3.2');
        $serie->setStatus('canceled');
        $serie->setTmdbId(28373);
        //si je veux vérifier que c'est bon
        dump($serie);

        $entityManager->persist($serie);
        $entityManager->flush();

        dump($serie);

        $entityManager->remove($serie);
        $entityManager->flush();

        return $this->render('serie/create.html.twig', [
        ]);
    }
}
