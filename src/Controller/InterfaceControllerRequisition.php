<?php

namespace Cursos\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface InterfaceControllerRequisition
{
    public function processRequisition(ServerRequestInterface $request): ResponseInterface;
}