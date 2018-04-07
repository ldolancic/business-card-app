<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BusinessCard;
use AppBundle\Form\BusinessCardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * @Route("/business-card")
 */
class BusinessCardController extends Controller
{
    /**
     * @Route("/", name="business_card_listing")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $businessCards = $entityManager->getRepository('AppBundle:BusinessCard')->findAll();

        return $this->render('businessCard/index.html.twig', array(
            'businessCards' => $businessCards
        ));
    }

    /**
     * @Route("/create", name="business_card_create")
     */
    public function createAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $businessCard = new BusinessCard();
        $form = $this->createForm(BusinessCardType::class, $businessCard);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessCard->storePicture();

            $entityManager->persist($businessCard);
            $entityManager->flush();

            // starts an async process for generating pdf - performance gains on web
            $process = new Process('../bin/console business-card:generate-pdf --id=' . $businessCard->getId());
            $process->start();

            return $this->redirect(
                $this->generateUrl('business_card_show', array(
                    'id' => $businessCard->getId()
                ))
            );
        }

        return $this->render('businessCard/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}", name="business_card_show")
     */
    public function showAction(BusinessCard $businessCard)
    {
        return $this->render('businessCard/show.html.twig', array(
            'businessCard' => $businessCard
        ));
    }
}





