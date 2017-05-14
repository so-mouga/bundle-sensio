<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\NexityBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use SL\NexityBundle\Entity\User;

/**
 * Description of UserController
 *
 * @author kevinmouga
 */
class UserController extends FOSRestController {

    /**
     * @Route("/user")
     */
    public function getAction(Request $request) {

        $civilite = $request->request->get('gender');
        $nom = $request->request->get('name');
        $prenom = $request->request->get('firstName');
        $codePostal = $request->request->get('postalCode');
        $email = $request->request->get('mail');
        $phone = $request->request->get('phone');
        $newsletterNexity = $request->request->get('newsletterNexity');
        $newsletterPartenaires = $request->request->get('newsletterPartenaires');
           
        //teste si le CP correspond à la BDD
        $findCp = $this->getDoctrine()->getManager()->getRepository('SLNexityBundle:CpAutocomplete')->findByCp($codePostal);
        if(empty($findCp)){
            return new View([
                'isSuccess' => false,
                'value' => 'veuillez saisir un code postal correct'],
                    Response::HTTP_OK);
        }
        $repository = $this->getDoctrine()->getManager()->getRepository('SLNexityBundle:User')->findByEmail($email);
        //teste si le mail existe déjà dans la BDD
        if (empty($repository)) {
            $user = New User();
            $user->setCivilite($civilite);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setCodePostal($codePostal);
            $user->setPhone($phone);
            $user->setEmail($email);
            $user->setNewsletterNexity($newsletterNexity);
            $user->setNewsletterPartenaires($newsletterPartenaires);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new View([
                'isSuccess' => true,
                'value' => 'Enregistrement validé'],
                    Response::HTTP_OK);
        } else {
            return new View([
                'isSuccess' => false,
                'value' => 'L\'adresse e-mail est déjà utilisée'],
                    Response::HTTP_OK);
        }
    }

    /**
     * @Route("/postalcode")
     */
    public function postalCodeAction(Request $request) {
        
        //récupération du cp et vérification si il correspond aux données de la table cpAutocomplete
        $postalCode = $request->request->get('codePostal');
        $repository = $this->getDoctrine()->getManager()->getRepository('SLNexityBundle:CpAutocomplete');
        $query = $repository->createQueryBuilder('p')
                ->where('p.cp LIKE :word')
                ->setParameter('word', $postalCode.'%')
                ->getQuery();
        $query->setMaxResults(10);
        $resu = $query->getResult();
        
        if (!empty($resu)) {
            return new View(
                    [ 'isSuccess' => true,
                        'value' => $resu]
                    
            , Response::HTTP_OK);
        }else{
            return new View([
                'isSuccess' => false,
                'value' => 'veuillez saisir un code postal correct'],
                    Response::HTTP_OK);
        }

        
    }
    

}
