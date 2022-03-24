<?php

namespace App\Controller\Security\OAuth;

use App\Controller\AbstractController;
use App\Domain\User\Command\Command\SetUserPasswordCommand;
use App\Domain\User\Query\Query\FindUserByIdQuery;
use App\Presentation\Form\Security\OAuth\FinaliseOAuthRegistrationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/oauth/finalise', methods: ['GET', 'POST'], name: 'security_oauth_finalise')]
class FinaliseOAuthRegistrationController extends AbstractController
{
    public function __invoke(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->queryBus->handle(new FindUserByIdQuery($this->getUser()->getUserIdentifier()));
        if ($user->getPassword()) {
            return $this->redirectToRoute('index');
        }

        $command = new SetUserPasswordCommand($user->getEmail(), '');
        $form = $this->createForm(FinaliseOAuthRegistrationForm::class, $command);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->dispatch($command);
            $this->addFlash('success', 'Password Saved Successfully');

            return $this->redirectToRoute('index');
        }

        return $this->render('security/finalise_oauth_registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
