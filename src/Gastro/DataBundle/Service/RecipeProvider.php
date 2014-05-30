<?php
/**
 * User: floran
 * Date: 25/05/2014
 * Time: 23:55
 */

namespace Gastro\DataBundle\Service;

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

} 