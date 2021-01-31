<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Joke;
use Doctrine\Common\Collections\ArrayCollection;

interface ChuckNorrisAPIInterface
{
	/**
	 * Gets a list of all available categories.
	 */
	public function getCategories(): ArrayCollection;

	/**
	 * Gets a random joke belonging to a certain category.
	 * @var string $categoryName The category name.
	 * @return Joke
	 */
	public function getRandomJoke(string $categoryName): Joke;
}