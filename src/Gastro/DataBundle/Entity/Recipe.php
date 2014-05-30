<?php
/**
 * User: floran
 * Date: 23/05/2014
 * Time: 00:43
 */

namespace Gastro\DataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Gastro\DataBundle\Entity\RecipeRepository")
 * @ORM\Table(name="recipe")
 */
class Recipe {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Ingredient", mappedBy="recipes", cascade={"persist"})
     **/
    protected $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity="Gastro\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    /**
     * Add ingredients
     *
     * @param \Gastro\DataBundle\Entity\Ingredient $ingredients
     * @return Recipe
     */
    public function addIngredient(\Gastro\DataBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients[] = $ingredients;

        return $this;
    }

    /**
     * Remove ingredients
     *
     * @param \Gastro\DataBundle\Entity\Ingredient $ingredients
     */
    public function removeIngredient(\Gastro\DataBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients->removeElement($ingredients);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Recipe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }


}
