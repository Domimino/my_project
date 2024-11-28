<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\CampRepository;
use App\Repository\InterestGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    #[Route('/events', name: 'public_events')]
    public function events(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();
        return $this->render('public/events.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/camps', name: 'public_camps')]
    public function camps(CampRepository $campRepository): Response
    {
        $camps = $campRepository->findAll();
        return $this->render('public/camps.html.twig', [
            'camps' => $camps,
        ]);
    }

    #[Route('/interest-groups', name: 'public_interest_groups')]
    public function interestGroups(InterestGroupRepository $interestGroupRepository): Response
    {
        $groups = $interestGroupRepository->findAll();
        return $this->render('public/interest_groups.html.twig', [
            'groups' => $groups,
        ]);
    }
}
