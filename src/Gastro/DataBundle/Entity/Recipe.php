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
    protected $recipeIngredient;

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
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="Gastro\UserBundle\Entity\Restaurant", inversedBy="recipes")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
    protected $restaurant;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    protected $image;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $inMenu = false;


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
        $this->recipeIngredient = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredient)
    {
        if (!$this->recipeIngredient->contains($recipeIngredient)) {
            $this->recipeIngredient->add($recipeIngredient);
            $recipeIngredient->setRecipe($this);
        }
        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient)
    {
        if ($this->recipeIngredient->contains($recipeIngredient)) {
            $this->recipeIngredient->removeElement($recipeIngredient);
            $recipeIngredient->setRecipe(null);
        }
        return $this;
    }

    public function setRecipeIngredient(RecipeIngredient $recipeIngredient)
    {
        $this->recipeIngredient = $recipeIngredient;
    }


    public function getRecipeIngredient()
    {
        return $this->recipeIngredient;
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
     * @param $restaurant
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $inMenu
     */
    public function setInMenu($inMenu)
    {
        $this->inMenu = $inMenu;
    }

    /**
     * @return mixed
     */
    public function getInMenu()
    {

        return $this->inMenu;
    }
}
