<?php

namespace Cursos\Controller;

use Cursos\Entity\Curso;
use Cursos\Helper\FlashMessageTrait;
use Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistence implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $get = $request->getQueryParams();
        $post = $request->getParsedBody();

        $description = filter_var(
            $post['description'],
            FILTER_SANITIZE_STRING
        );

        $id = filter_var(
            $get['id'],
            FILTER_VALIDATE_INT
        );

        if (!is_null($id) && $id !== false) {
            $course = $this->entityManager->find(Curso::class, $id);
            $course->setDescricao($description);
            $this->defineMessage('success', 'Curso atualizado com sucesso!');
        } else {
            $course = new Curso();
            $course->setDescricao($description);
            $this->entityManager->persist($course);
            $this->defineMessage('success', 'Curso salvo com sucesso!');
        }

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/']);
    }
}