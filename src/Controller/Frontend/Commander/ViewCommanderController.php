<?php

namespace App\Controller\Frontend\Commander;

use App\Controller\Frontend\StimulusFrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commander/{name}', name: 'frontend_view_commander', methods: ['GET'])]
class ViewCommanderController extends StimulusFrontendController
{
    public function __invoke(string $name): Response
    {
        return $this->renderStimulusTemplate([
            'title' => 'View Commander',
            'controller' => 'commanders--view',
            'props' => $name,
        ]);
    }
}
