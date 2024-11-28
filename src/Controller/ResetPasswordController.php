<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ResetPasswordController extends AbstractController
{
    public function request(Request $request, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                $token = $tokenGenerator->generateToken();
                $user->setResetToken($token);
                $entityManager->flush();

                $email = (new Email())
                    ->from('your-email@example.com')
                    ->to($user->getEmail())
                    ->subject('Reset Password')
                    ->html('<a href="http://127.0.0.1:8000/reset-password/reset?token=' . $token . '">Reset Password</a>');

                $mailer->send($email);

                $this->addFlash('success', 'Email sent!');
                return $this->redirectToRoute('login');
            }

            $this->addFlash('error', 'User not found!');
        }

        return $this->render('reset_password/request.html.twig');
    }

    public function reset(Request $request, EntityManagerInterface $entityManager, UserAuthenticatorInterface $authenticator): Response
    {
        $token = $request->query->get('token');
        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            throw $this->createNotFoundException('Invalid token');
        }

        if ($request->isMethod('POST')) {
            $password = $request->request->get('password');
            $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
            $user->setResetToken(null);
            $entityManager->flush();

            $this->addFlash('success', 'Password reset successfully!');
            return $this->redirectToRoute('login');
        }

        return $this->render('reset_password/reset.html.twig');
    }
}
