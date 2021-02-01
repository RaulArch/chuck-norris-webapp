<?php

namespace App\Controller;

use App\Service\ChuckNorrisAPIInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jokes", name="joke_")
 */
class JokeController extends AbstractController
{
	/**
	 * @Route("/{categoryName}", name="belonging_to_category", methods={"POST"})
	 */
	public function index(ChuckNorrisAPIInterface $chuckNorrisAPI, $categoryName): JsonResponse
	{
		$joke = $chuckNorrisAPI->getRandomJoke($categoryName);

		return new JsonResponse([
				"joke_text" => $joke->getValue()
		]);
	}
}
