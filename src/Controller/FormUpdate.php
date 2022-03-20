<?php

namespace Cursos\Controller;

use Cursos\Entity\Curso;
use Cursos\Helper\RenderHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormUpdate implements RequestHandlerInterface
{
    use RenderHtmlTrait;

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
            return new Response(302, ['Location' => '/']);
        }

        $repositoryCourses = $this->entityManager->getRepository(Curso::class);
        /** @var Curso $course */
        $course = $repositoryCourses->find($id);
        $data = [
            'course' => $course,
            'title' => 'Atualizar Curso ' . $course->getDescricao()
        ];
        $path = 'courses/form.php';
        $html = $this->renderHtml($path, $data);

        return new Response(200, [], $html);
    }
}