<?php

namespace App\Controller\Frontend\Governor;

use App\Controller\Frontend\StimulusFrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/governor/{id}', name: 'frontend_view_governor', methods: ['GET'])]
class ViewGovernorController extends StimulusFrontendController
{
    public function __invoke(string $id): Response
    {
        return $this->renderStimulusTemplate([
            'title' => 'View Governor',
            'controller' => 'governors--view',
            'props' => $id,
        ]);
    }
}
