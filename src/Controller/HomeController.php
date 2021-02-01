<?php

namespace App\Controller;

use App\Service\ChuckNorrisAPIInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
	/**
	 * @Route("/", name="home", methods={"GET"})
	 */
	public function index(ChuckNorrisAPIInterface $chuckNorrisAPI): Response
	{
		$categories = $chuckNorrisAPI->getCategories()->toArray();

		return $this->render('home/home.html.twig', [
				'categories' => $categories,
		]);
	}
}
