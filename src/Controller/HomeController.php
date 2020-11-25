<?php

namespace App\Controller;

use App\File\UploadService;
use Doctrine\DBAL\Connection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

class HomeController extends AbstractController
{
    public function homepage(
        ResponseInterface $response,
        ServerRequestInterface $request,
        UploadService $uploadService,
        Connection $connection)
    {

        $listeFichiers = $request->getUploadedFiles();


        if (isset($listeFichiers['file'])) {
             /** @var UploadedFileInterface $files */
             $files = $listeFichiers['file'];
            
             // récupérer le nouveau nom du fichier
             $nouveauNom = $uploadService->saveFile($files);
        // Enregistrer les infos du fichier en base de données
        // Afficher un message à la base
        $connection->insert('fichier', [
            'nom' => $nouveauNom,
            'nom_original'=>$files->getClientFilename(),
        ]);

    

       
    }
          return $this->template($response,'home.html.twig');

    }
    

    public function download(ResponseInterface $response, int $id)
{
    $response->getBody()->write(sprintf('Identifiant: %d', $id));
    return $response;
}
      
    }

    //  $nouveau_nom = '...';
    //  $fichier->moveTo($nouveauNom);