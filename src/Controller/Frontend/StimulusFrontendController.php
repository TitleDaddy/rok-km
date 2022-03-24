<?php

namespace App\Controller\Frontend;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class StimulusFrontendController extends AbstractController
{
    public function renderStimulusTemplate(?array $data = null): Response
    {
        return $this->render('partials/stimulus_controller.html.twig', $data);
    }
}
