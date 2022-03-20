<?php

namespace Cursos\Controller;

use Cursos\Helper\RenderHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormInsertion implements RequestHandlerInterface
{
    use RenderHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'title' => 'Novo Curso'
        ];
        $path = 'courses/form.php';
        $html = $this->renderHtml($path, $data);

        return new Response(200, [], $html);
    }
}