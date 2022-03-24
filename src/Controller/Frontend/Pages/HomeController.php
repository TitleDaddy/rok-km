<?php

namespace App\Controller\Frontend\Pages;

use App\Controller\Frontend\StimulusFrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'index')]
class HomeController extends StimulusFrontendController
{
    public function __invoke(): Response
    {
        return $this->renderStimulusTemplate([
            'title' => 'Home',
            'controller' => 'pages--home',
        ]);
    }
}
