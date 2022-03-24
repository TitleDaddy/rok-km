<?php

namespace App\Controller\Frontend\Kingdom;

use App\Controller\Frontend\StimulusFrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kingdoms', name: 'frontend_list_kingdoms', methods: ['GET'])]
class ListKingdomsController extends StimulusFrontendController
{
    public function __invoke(): Response
    {
        return $this->renderStimulusTemplate([
            'title' => 'Kingdom List',
            'controller' => 'kingdoms--list',
        ]);
    }
}
