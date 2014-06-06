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

    public function getAllUserMenuRecipes($userId)
    {
        return $this->em->createQueryBuilder('r')
            ->select('r')
            ->where('r.isInMenu = true')
            ->andWhere('r.user = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getResult();
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

    public function getUserMenuRecipesCount($userId)
    {
        return $this->em->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->where('r.isInMenu = true')
            ->andWhere('r.user = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function calculateRecipeCost(Recipe $recipe)
    {
        $recipeIngredients = $recipe->getRecipeIngredient();
        $cost = 0;

        foreach ($recipeIngredients as $recipeIngredient)
            $cost +=  $this->calculateRecipeIngredientCost($recipeIngredient);

        return $cost;
    }

    public function calculateRecipeIngredientCost(RecipeIngredient $recipeIngredient)
    {
        $ingredient = new Ingredient($recipeIngredient->getIngredient());
        if ($recipeIngredient->getUnit() == RecipeIngredient::UNIT_UNITARY)
            $cost = $recipeIngredient->getQte() * $ingredient->getPriceForUnit();
        elseif ($recipeIngredient->getUnit() == RecipeIngredient::UNIT_GR || $recipeIngredient->getUnit() == RecipeIngredient::UNIT_CLITER)
            $cost = ($recipeIngredient->getQte()/1000) * $ingredient->getPriceForUnit();
        else
            $cost = $recipeIngredient->getQte() * $ingredient->getPriceForUnit();

        return $cost;
    }

    public function getUserAverageCost($userId)
    {
        $recipes =  $this->em->createQueryBuilder('r')
        ->select('r')
        ->where('r.user = :user_id')
        ->setParameter('user_id', $userId)
        ->getQuery()
        ->getResult();

        $cost = 0;
        $i = 0;
        foreach ($recipes as $recipe)
        {
            $cost += $this->calculateRecipeCost($recipe)/ $recipe->getPortions();
            $i++;
        }
        if ($i == 0)
            return null;
        else
            return $cost/$i;
    }

} 