<?php

namespace Cursos\Controller;

use Cursos\Entity\Usuario;
use Cursos\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizeLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post = $request->getParsedBody();

        $email = filter_var(
            $post['email'],
            FILTER_VALIDATE_EMAIL
        );

        $userRepository = $this->entityManager->getRepository(Usuario::class);
        /** @var Usuario $user */
        $user = $userRepository->findOneBy(['email' => $email]);

        if (is_null($email) || $email === false) {
            $this->defineMessage('danger', 'Email inválido');
            return new Response(302, ['Location' => '/login']);
        }

        $password = filter_var(
            $post['password'],
            FILTER_SANITIZE_STRING
        );

        if (is_null($user) || $user->senhaEstaCorreta($password) === false) {
            $this->defineMessage('danger', 'Senha inválida');
            return new Response(302, ['Location' => '/login']);
        }

        $_SESSION['logged'] = $user->getEmail();

        return new Response(302, ['Location' => '/']);
    }
}
