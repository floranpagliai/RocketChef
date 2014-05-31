<?php
/**
 * User: floran
 * Date: 25/05/2014
 * Time: 23:55
 */

namespace Gastro\DataBundle\Service;

use Gastro\DataBundle\Entity\Ingredient;
use Gastro\DataBundle\Entity\Recipe;
use Gastro\DataBundle\Entity\RecipeIngredient;
use Gastro\DataBundle\Entity\RecipeRepository;

class RecipeProvider {

    private $em;

    public function __construct(RecipeRepository $em)
    {
        $this->em = $em;
    }

    public function getAllRecipes()
    {
        return $this->em->findAll();
    }


    public function getRecipeById($id)
    {
        return $this->em->findOneBy(array('id' => $id));
    }

    public function getRecipesCount()
    {
        return $this->em->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getUserRecipesCount($userId)
    {
        return $this->em->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->where('r.user = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function calculateCost(Recipe $recipe)
    {
        $recipeIngredients = $recipe->getRecipeIngredients();
        $cost = 0;

        foreach ($recipeIngredients as $recipeIngredient)
        {
            $ingredient = new Ingredient($recipeIngredient->getIngredient());
            if ($ingredient->getUnit() == Ingredient::UNIT_UNITARY)
                $cost += $recipeIngredient->getQte() * $ingredient->getPriceByUnit();
            else
                $cost += ($recipeIngredient->getQte()/1000) * $ingredient->getPriceByUnit();
        }//TODO prendre en compte les unités (unité donnée et unité de prix)

        return $cost;
    }

} 