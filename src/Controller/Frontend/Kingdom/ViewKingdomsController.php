<?php

namespace App\Controller\Frontend\Kingdom;

use App\Controller\Frontend\StimulusFrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kingdom/{number}', name: 'frontend_view_kingdom', methods: ['GET'])]
class ViewKingdomsController extends StimulusFrontendController
{
    public function __invoke(string $number): Response
    {
        return $this->renderStimulusTemplate([
            'title' => 'Kingdom View',
            'controller' => 'kingdoms--view',
            'props' => $number,
        ]);
    }
}
