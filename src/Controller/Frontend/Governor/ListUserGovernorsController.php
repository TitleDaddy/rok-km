<?php

namespace App\Controller\Frontend\Governor;

use App\Controller\Frontend\StimulusFrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/governor/mine', name: 'frontend_list_user_governors', methods: ['GET'])]
class ListUserGovernorsController extends StimulusFrontendController
{
    public function __invoke(): Response
    {
        return $this->renderStimulusTemplate([
            'title' => 'My Governors',
            'controller' => 'governors--list-mine',
        ]);
    }
}
