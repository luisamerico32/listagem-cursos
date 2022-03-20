<?php

namespace Cursos\Helper;

trait RenderHtmlTrait
{
    public function renderHtml(string $pathHtml, array $data): string
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../../view/' . $pathHtml;

        return ob_get_clean();
    }
}