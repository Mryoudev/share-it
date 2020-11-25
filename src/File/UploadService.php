<?php

namespace App\File;

use Psr\Http\Message\UploadedFileInterface;

/** Service en charge de l'enregistrement de fichiers */
class UploadService{
     public const FILES_DIR = __DIR__ . '/../../files';


    /** àvar string chemin vers le dossier ou enregistrer les fichiers */
   
    /** 
     * Enregistrer un fichier
     * 
     *  @param UploadedFileInterface $file le fichier chargé à enregistrer
     *  @return string le nouveau nom du fichier */


    public function saveFile(UploadedFileInterface $file): string{
        
        $filename = $this->generateFilename($file);

        $path= self::FILES_DIR . '/'. $filename;
        $file->moveTo($path);
        return $filename;

    }

    /**
     * Générer un nom de fichier aléatoire et unique
     * 
     * @param UploadedFileInterface $file le fichier à enregistrer
     * @return string le nom unique générer
     */


    private function generateFilename(UploadedFileInterface $file): string{
        
        $filename = date('YmdHis');
        $filename.= bin2hex(random_bytes(8));
        $filename.= ','. pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
        return $filename;

        }
}
        /**
         * Ecrire le code de generateFilename()
         * Utiliser la méthode generateFilename() dans la méthode saveFile()
         * Ajouter un argument UploadService dans le HomeController et utiliser saveFile()
         */



