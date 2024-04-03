<?php

use Psr\Container\ContainerInterface;
use Intervention\Image\ImageManager;

class UploadService
{
    protected $container;
    protected $imageManager;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->imageManager = new ImageManager(array('driver' => 'gd'));
    }

    public function upload($file)
    {
        if ($file->getError() === UPLOAD_ERR_OK) {
            $uploadPath = $this->container->get('upload_directory');

            // Gera um nome único para a imagem
            $filename = $this->generateFilename($file);

            // Caminho completo para onde a imagem será salva
            $fullPath = $uploadPath . DIRECTORY_SEPARATOR . $filename;

            // Utiliza o Intervention Image para manipular a imagem aqui, se necessário
            $image = $this->imageManager->make($file->getStream())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Salva a imagem no diretório de uploads
            $image->save($fullPath);

            return $filename; // Retorna o nome do arquivo da imagem salva
        }

        return false; // Retorna falso se houver um erro no upload
    }

    protected function generateFilename($file)
    {
        // Extrai a extensão do arquivo original
        $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

        // Gera um nome de arquivo único
        return sprintf('%s.%s', sha1(time()), $extension);
    }
}
