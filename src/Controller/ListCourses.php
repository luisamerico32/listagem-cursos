<?php

namespace Cursos\Controller;

use Cursos\Entity\Curso;
use Cursos\Helper\RenderHtmlTrait;
use Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListCourses implements RequestHandlerInterface
{
    use RenderHtmlTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $repositoryCourses = $this->entityManager->getRepository(Curso::class);

        $data = [
            'courses' => $repositoryCourses->findAll(),
            'title' => 'Listar Cursos'
        ];
        $path = 'courses/list-courses.php';
        $html = $this->renderHtml($path, $data);

        return new Response(200, [], $html);
    }
}