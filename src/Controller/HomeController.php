<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends AbstractController
{
    public function homepage(ResponseInterface $response, ServerRequestInterface $request)
    {

        $request->getUploadedFiles();

    $files = $request->getUploadedFiles();
    var_dump($files['file']);

        return $this->template($response,'home.html.twig');

    }

    public function download(ResponseInterface $response, int $id)
{
    $response->getBody()->write(sprintf('Identifiant: %d', $id));
    return $response;
}
      
    }