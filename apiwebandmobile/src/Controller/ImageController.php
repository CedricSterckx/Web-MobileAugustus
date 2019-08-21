<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Melihovv\Base64ImageDecoder\Base64ImageEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Model\PDOMessageModel;

class ImageController extends AbstractController
{
    /**
     * @Route("/image",methods={"GET"}, name="image")
     */
    public function getImageBase64()
    {
        $encoder = Base64ImageEncoder::fromFileName('C:\Users\cedri\Desktop\transpiration.jpg',
            $allowedFormats = ['jpeg', 'png', 'gif']);
        $output = $encoder->getContent(); // base64 encoded image bytes.;
        return new JsonResponse($output, 200);
    }
}
