<?php

namespace App\Controller\Frontend\Commander;

use App\Controller\Frontend\StimulusFrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commander', name: 'frontend_list_commanders', methods: ['GET'])]
class ListCommanderController extends StimulusFrontendController
{
    public function __invoke(): Response
    {
        return $this->renderStimulusTemplate([
            'title' => 'Commander List',
            'controller' => 'commanders--list',
        ]);
    }
}
