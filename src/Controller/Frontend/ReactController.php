<?php

namespace App\Controller\Frontend;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/react')]
class ReactController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('layouts/react.html.twig');
    }
}
