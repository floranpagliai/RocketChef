<?php
/**
 * User: floran
 * Date: 23/05/2014
 * Time: 00:43
 */

namespace Gastro\DataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Gastro\DataBundle\Entity\RecipeRepository")
 * @ORM\Table(name="recipe")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\OneToMany(targetEntity="RecipeIngredient", mappedBy="recipe", cascade={"persist"}, orphanRemoval=TRUE)
     */
    protected $recipeIngredients;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $portions;

    /**
     * @ORM\Column(type="float")
     */
    protected $cost = 0.0;

    /**
     * @ORM\Column(type="float")
     */
    protected $price = 0.0;

    /**
     * @ORM\ManyToOne(targetEntity="Gastro\UserBundle\Entity\User", inversedBy="recipes")
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
        $this->recipeIngredients = new ArrayCollection();
    }

    public function addIngredient(RecipeIngredient $recipeIngredient)
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->add($recipeIngredient);
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function getRecipeIngredient()
    {
        return $this->recipeIngredients;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
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
     * @param mixed $portions
     */
    public function setPortions($portions)
    {
        $this->portions = $portions;
    }

    /**
     * @return mixed
     */
    public function getPortions()
    {
        return $this->portions;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
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
