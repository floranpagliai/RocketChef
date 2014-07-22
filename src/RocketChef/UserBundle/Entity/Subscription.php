<?php
/**
 * Subscription.php
 * User: floran.pagliai
 * Date: 22/07/14
 * Time: 10:20
 */

namespace RocketChef\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="subscription")
 * @ORM\Entity()
 */
class Subscription 
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="recipeMax", type="integer")
     */
    private $recipeMax;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $recipeMax
     */
    public function setRecipeMax($recipeMax)
    {
        $this->recipeMax = $recipeMax;
    }

    /**
     * @return mixed
     */
    public function getRecipeMax()
    {
        return $this->recipeMax;
    }
} 