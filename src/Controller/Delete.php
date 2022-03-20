<?php

namespace Cursos\Controller;

use Cursos\Entity\Curso;
use Cursos\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Delete implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var(
            $queryParams['id'],
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            $this->defineMessage('danger', 'Curso inexistente');
            return new Response(302, ['Location' => '/']);
        }

        $course = $this->entityManager->getReference(Curso::class, $id);
        $nameCourse = $course->getDescricao();
        $this->entityManager->remove($course);
        $this->entityManager->flush();

        $this->defineMessage('success', "Curso: {$nameCourse}. Excluido com sucesso!");

        return new Response(302, ['Location' => '/']);
    }
}