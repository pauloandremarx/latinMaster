<?php

namespace app\classes;

use Intervention\Image\ImageManager;

function path()
{
    $vendorDir = dirname(dirname(__FILE__));
    return dirname($vendorDir);
}

class Image
{
    private $intervention;
    private $image;
    private $type;
    private $resized = false;
    private $resizeWidth;
    private $resizeHeight;
    private $uploadedFileName;

    public function __construct($imageName = null)
    {
        $this->intervention = new ImageManager;
        if ($imageName !== null && isset($_FILES[$imageName])) {
            $this->image = $_FILES[$imageName];
        } else {
            $this->image = null;
        }
    }

    private function generateUniqueName()
    {
        $extension = pathinfo($this->image['name'], PATHINFO_EXTENSION);
        return md5(uniqid(rand(), true)) . ".$extension";
    }

    public function size($type)
    {
        [$this->resizeWidth, $this->resizeHeight] = $this->determineSizeByType($type);
        $this->resized = true;
        return $this;
    }

    private function determineSizeByType($type)
    {
        switch ($type) {
            case 'banner':
                $width = 1200; // Exemplo, ajuste conforme necessário
                $height = 300; // Exemplo, ajuste conforme necessário
                break;
            case 'thumbnail':
                $width = 150; // Exemplo, ajuste conforme necessário
                $height = 150; // Exemplo, ajuste conforme necessário
                break;
            case 'post':
            default:
                $width = 600; // Exemplo, ajuste conforme necessário
                $height = null; // Altura será determinada proporcionalmente
                break;
        }
        return [$width, $height];
    }



    public function upload()
    {
        if (!$this->resized) {
            throw new \Exception("Please call the size method to resize the image before uploading.");
        }
        $this->uploadedFileName = $this->generateUniqueName(); // Certifique-se de que esta linha esteja definindo a propriedade da classe
        $filePath = "uploads/" . $this->uploadedFileName;
        $image = $this->intervention->make($this->image['tmp_name']);

        // Aplica redimensionamento com centralização e possível corte
        if ($this->resizeWidth && $this->resizeHeight) {
            // Utiliza o método fit para ajustar a imagem ao centro, aplicando um "zoom" se necessário
            $image->fit($this->resizeWidth, $this->resizeHeight, function ($constraint) {
                $constraint->upsize(); // Evita que a imagem seja ampliada além de seu tamanho original
            });
        } else {
            // Se apenas a largura é especificada, redimensiona mantendo a proporção
            // Sem a garantia de preenchimento total das dimensões, mas sem distorção
            $image->resize($this->resizeWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $image->save($filePath);
        return $this->uploadedFileName;
    }


    public function getName()
    {
        return $this->uploadedFileName; // Retorna o nome do arquivo armazenado após o upload
    }


    public function deleteByName($fileName)
    {
        if (!$fileName) {
            // Se não houver nome de arquivo fornecido, não faça nada ou registre um erro conforme necessário
            return false;
        }

        $filePath = path() . '/public/uploads/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
        return false;
    }
}
