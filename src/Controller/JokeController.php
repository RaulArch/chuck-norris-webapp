<?php

namespace App\Controller;

use App\Service\ChuckNorrisAPIInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jokes")
 */
class JokeController extends AbstractController
{
	private $session;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}

	/**
	 * @Route("/session", name="get_all_session_jokes", methods={"GET"})
	 */
	public function getAllSessionJokes()
	{
		$jokes = $this->session->get('jokes', []);

		return new JsonResponse([
				"jokes" => $jokes
		]);
	}

	/**
	 * @Route("/session", name="delete_all_session_jokes", methods={"DELETE"})
	 */
	public function deleteAllSessionJokes()
	{
		$this->session->set('jokes', []);

		return new JsonResponse();
	}

	/**
	 * @Route("/{categoryName}", name="joke_belonging_to_category", methods={"GET"})
	 */
	public function getRandomJoke(ChuckNorrisAPIInterface $chuckNorrisAPI, $categoryName): JsonResponse
	{
		$joke = $chuckNorrisAPI->getRandomJoke($categoryName);
		$jokeText = $joke->getValue();

		$sessionJokes = $this->session->get('jokes', []);

		$sessionJokes[] = $jokeText;

		$this->session->set('jokes', $sessionJokes);

		return new JsonResponse([
				"joke_text" => $jokeText
		]);
	}
}
