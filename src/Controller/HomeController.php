<?php

namespace App\Controller;

use App\Entity\Coureur;
use App\Entity\User;
use App\Repository\CoureurRepository;
use App\Repository\EquipeRepository;
use App\Repository\EtapeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{

    #[Route('/', name: 'home')]
    function index(): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/search', name: 'search')]
    function search(){
        
    }
    #[Route('/coureurs', name: 'coureurs')]
    function coureurs(CoureurRepository $coureurRepository): Response
    {
        $coureurs = $coureurRepository->createQueryBuilder('c')
            ->select('c')
            ->getQuery()
            ->getResult();
        $coureursArray = array_map(function ($coureur) {
            return [
                'num_dossard' => $coureur->getNumDossard(),
                'nom' => $coureur->getNom(),
                'prenom' => $coureur->getPrenom(),
                'date_naissance' => $coureur->getDateDeNaissance()->format('d/m/Y'),
                'code_pays' => $coureur->getCodePays()->getNom(),
                'code_equipe' => $coureur->getCodeEquipe()->getNom(),

            ];
        }, $coureurs);

        dump($coureursArray);
        return $this->render('home/coureurs.html.twig', [
            'coureurs' => $coureursArray,
        ]);
    }
    #[Route('/etapes', name: 'etapes')]
    function etapes(EtapeRepository $etapeRepository): Response
    {
        $etapes = $etapeRepository->createQueryBuilder('e')
            ->select('e')
            ->getQuery()
            ->getResult();

        $etapesArray = array_map(function ($etape) {
            return [
                'num_etape' => $etape->getNum_etape(),
                'date' => $etape->getDate()->format('d/m/Y'),
                'type' => $etape->getType(),
                'distance_parcouru' => $etape->getDistanceParcouru(),
                'ville_depart' => $etape->getVilleDepart()->getNom(),
                'ville_arrive' => $etape->getVilleArrive()->getNom(),
                'vainqueur' => $etape->getVainqueur()->getNom(),
            ];
        }, $etapes);

        dump($etapesArray);

        return $this->render('home/etapes.html.twig', [
            'etapes' => $etapesArray,
        ]);
    }


    #[Route('/exercice1', name: 'exercice1')]
    function exercice1(CoureurRepository $coureurRepository): Response
    {
        $queryBuilder = $coureurRepository->createQueryBuilder('c');
        $queryBuilder->select('c.num_dossard', 'c.nom')
            ->where('c.code_pays = :code_pays')
            ->setParameter('code_pays', 'FRA');

        $coureurs = $queryBuilder->getQuery()->getResult();

        dump($coureurs);
        return $this->render('home/exercice1.html.twig', [
            'coureurs' => $coureurs,
        ]);
    }

    #[Route('/exercice2', name: 'exercice2')]
    function exercice2(EquipeRepository $equipeRepository): Response
    {
        $entityManager = $equipeRepository->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT c.num_dossard, c.nom, p.nom as pays
            FROM App\Entity\Coureur c
            INNER JOIN c.code_equipe e
            INNER JOIN c.code_pays p
            WHERE e.nom = 'TOTALENERGIES'"
        );
        $coureurs = $query->getResult();
        dump($coureurs);
        return $this->render('home/exercice2.html.twig', [
            'coureurs' => $coureurs,
        ]);
    }
    #[Route('/exercice3', name: 'exercice3')]
    function exercice3(CoureurRepository $coureurRepository): Response
    {
        $entityManager = $coureurRepository->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT c.nom 
            FROM App\Entity\Coureur c
            where c.num_dossard in (SELECT c.num_dossard from App\Entity\Resultat r where r.bonification = 0)"
        );
        $coureurs = $query->getResult();
        dump($coureurs);

        return $this->render('home/exercice3.html.twig', [
            'coureurs' => $coureurs,
        ]);
    }
    #[Route('/exercice4', name: 'exercice4')]
    function exercice4(EquipeRepository $equipeRepository): Response
    {
        $entityManager = $equipeRepository->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT c.nom
            FROM App\Entity\Coureur c
            WHERE c.num_dossard NOT IN (
                SELECT v.num_dossard 
                FROM App\Entity\Etape e 
                JOIN e.vainqueur v
            )"
        );

        $coureurs = $query->getResult();
        dump($coureurs);

        return $this->render('home/exercice4.html.twig', [
            'coureurs' => $coureurs,
        ]);
    }
    #[Route('/exercice5', name: 'exercice5')]
    function exercice5(EquipeRepository $equipeRepository): Response
    {
        $entityManager = $equipeRepository->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT c.nom 
            FROM App\Entity\Coureur c
            where c.num_dossard in (SELECT c.num_dossard from App\Entity\Resultat r where r.bonification = 0)"
        );

        $data = $query->getResult();
        dump($data);

        return $this->render('home/exercice5.html.twig', [
            'data' => $data,
        ]);
    }
    #[Route('/exercice6', name: 'exercice6')]
    function exercice6(EquipeRepository $equipeRepository): Response
    {
        $entityManager = $equipeRepository->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT v.nom
            FROM App\Entity\Ville v
            WHERE v.code_pays = 'FRA' AND v.id NOT IN (
                SELECT villeDepart.id 
                FROM App\Entity\Etape e 
                JOIN e.ville_depart villeDepart
            ) OR v.id NOT IN (
                SELECT villeArrive.id 
                FROM App\Entity\Etape et 
                JOIN et.ville_arrive villeArrive
            )"
        );

        $data = $query->getResult();
        dump($data);

        return $this->render('home/exercice6.html.twig', [
            'data' => $data,
        ]);
    }
}
