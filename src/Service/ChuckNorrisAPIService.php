<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Joke;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Service to get data from "Chack Norris Jokes API" (https://api.chucknorris.io/).
 */
class ChuckNorrisAPIService implements ChuckNorrisAPIInterface
{

	private $httpClient;

	public function __construct(HttpClientInterface $httpClient)
	{
		$this->httpClient = $httpClient;
	}

	public function getCategories(): ArrayCollection
	{
		$categories = new ArrayCollection();

		$response = $this->httpClient->request(
				"GET",
				"https://api.chucknorris.io/jokes/categories"
		);

		$categoriesArray = $response->toArray();

		foreach($categoriesArray as $categoryName)
		{
			$category = new Category();
			$category->setName($categoryName);

			$categories->add($category);
		}

		return $categories;
	}

	public function getRandomJoke(string $categoryName): Joke
	{
		$joke = new Joke();

		$response = $this->httpClient->request(
				"GET",
				"https://api.chucknorris.io/jokes/random?category={$categoryName}"
		);

		$jokeObject = (object)$response->toArray();

		$joke->setCreatedAt( new \DateTime($jokeObject->created_at) );
		$joke->setIconUrl( $jokeObject->icon_url );
		$joke->setUpdatedAt( new \DateTime($jokeObject->updated_at) );
		$joke->setUrl( $jokeObject->url );
		$joke->setValue( $jokeObject->value );
		$joke->setChuckNorrisJokesApiId( $jokeObject->id );

		$categories = $jokeObject->categories;

		foreach($categories as $categoryName)
		{
			$category = new Category();
			$category->setName($categoryName);

			$joke->addCategory($category);
		}

		return $joke;
	}
}