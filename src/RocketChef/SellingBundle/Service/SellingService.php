<?php
/**
 * SellingService.php
 * User: floran.pagliai
 * Date: 21/07/14
 * Time: 16:49
 */

namespace RocketChef\SellingBundle\Service;


use RocketChef\DataBundle\Entity\SellingDay;
use RocketChef\DataBundle\Entity\SellingDayRecipe;
use RocketChef\DataBundle\Service\RecipeProvider;

class SellingService
{
    public function calculateSellingDay(SellingDay $sellingDay)
    {
        $cost = 0;
        $CA = 0;
        foreach ($sellingDay->getRecipes() as $SellingRecipe) {
            $SellingRecipe->setSellingDay($sellingDay);
            $cost += ($SellingRecipe->getRecipe()->getCost() / $SellingRecipe->getRecipe()->getPortions()) * $SellingRecipe->getQte();
            $CA += $SellingRecipe->getRecipe()->getPrice() * $SellingRecipe->getQte();
        }
        $sellingDay->setCost($cost);
        $sellingDay->setCA($CA);
        return $sellingDay;
    }

} 