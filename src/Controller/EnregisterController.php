<?php
// src/Controller/EnregisterController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationFormType;



class EnregisterController extends AbstractController
{

    public function register(Request $request, SessionInterface $session): Response
    {
        $form = $this->createForm(RegistrationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            // Enregistrer les informations en session
            $session->set('user', [
                'login' => $formData['login'],
                'password' => $formData['password'],
            ]);

            // Rediriger l'utilisateur vers une nouvelle page
            return $this->redirectToRoute('user_profile', ['login' => $formData['login']]);
        }

        return $this->render('register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function userProfile($login): Response
    {
        return $this->render('profile.html.twig', [
            'login' => $login,
        ]);
    }
}
