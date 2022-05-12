<?php

namespace App\Controller;

use App\Component\Food\src\Domain\Repository\OpenFoodApiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ApiFoodController extends AbstractController
{
    #[Route('/api/food', name: 'app_api_food')]
    public function index(OpenFoodApiRepository $apiRepository): Response
    {
        //$api = new \OpenFoodFacts\Api('food','fr');
        //$product = $api->getProduct('5449000000996');
        dd($apiRepository->execute());
        return $this->json([
            'message' => 'Welcome to your new controllesdgdsr!',
            'path' => 'src/Controller/ApiFoodController.php',
        ]);
    }
}
