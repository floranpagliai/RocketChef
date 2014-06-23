<?php
/**
 * User: floran
 * Date: 23/05/2014
 * Time: 00:02
 */

namespace RocketChef\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="RocketChef\DataBundle\Entity\IngredientRepository")
 * @ORM\Table(name="ingredient")
 */
class Ingredient {

    const UNIT_UNITARY  = 0;
    const UNIT_KG       = 1;
    const UNIT_LITER    = 2;

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
     * @ORM\Column(type="float")
     */
    protected $priceForUnit;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $unit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $startMonthSeason;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $endMonthSeason;

    /**
     * @ORM\OneToMany(targetEntity="RecipeIngredient", mappedBy="ingredient", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $recipes;

    /**
     * @ORM\ManyToOne(targetEntity="RocketChef\UserBundle\Entity\Restaurant", inversedBy="ingredients", cascade={"persist", "remove"})
     */
    protected $restaurant;

    /**
     * Constructor
     */
    public function __construct(Ingredient $ingredient = null)
    {
        if ($ingredient){
            $this->id = $ingredient->getId();
            $this->name = $ingredient->getName();
            $this->priceForUnit = $ingredient->getPriceForUnit();
            $this->unit = $ingredient->getUnit();

            $this->recipes = $ingredient->getRecipes();
        } else
            $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     * @return Ingredient
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
     * Set priceByUnit
     *
     * @param string $priceByUnit
     * @return Ingredient
     */
    public function setPriceForUnit($priceByUnit)
    {
        $this->priceForUnit = $priceByUnit;

        return $this;
    }

    /**
     * Get priceByUnit
     *
     * @return string 
     */
    public function getPriceForUnit()
    {
        return $this->priceForUnit;
    }

    /**
     * Set unit
     *
     * @param integer $unit
     * @throws \InvalidArgumentException
     * @return Ingredient
     */
    public function setUnit($unit)
    {
        if (!in_array($unit, array(self::UNIT_KG, self::UNIT_LITER, self::UNIT_UNITARY)))
            throw new \InvalidArgumentException("Invalid unit");
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return integer 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set startMonthSeason
     *
     * @param \DateTime $startMonthSeason
     * @return Ingredient
     */
    public function setStartMonthSeason($startMonthSeason)
    {
        $this->startMonthSeason = $startMonthSeason;

        return $this;
    }

    /**
     * Get startMonthSeason
     *
     * @return \DateTime 
     */
    public function getStartMonthSeason()
    {
        return $this->startMonthSeason;
    }

    /**
     * Set endMonthSeason
     *
     * @param \DateTime $endMonthSeason
     * @return Ingredient
     */
    public function setEndMonthSeason($endMonthSeason)
    {
        $this->endMonthSeason = $endMonthSeason;

        return $this;
    }

    /**
     * Get endMonthSeason
     *
     * @return \DateTime 
     */
    public function getEndMonthSeason()
    {
        return $this->endMonthSeason;
    }

    public function addIngredient(RecipeIngredient $recipeIngredient)
    {
        if (!$this->recipes->contains($recipeIngredient)) {
            $this->recipes->add($recipeIngredient);
            $recipeIngredient->setIngredient($this);
        }

        return $this;
    }

    /**
     * @param mixed $recipes
     */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * @return mixed
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * @param mixed $restaurant
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
     * Add recipes
     *
     * @param \RocketChef\DataBundle\Entity\RecipeIngredient $recipes
     * @return Ingredient
     */
    public function addRecipe(\RocketChef\DataBundle\Entity\RecipeIngredient $recipes)
    {
        $this->recipes[] = $recipes;

        return $this;
    }

    /**
     * Remove recipes
     *
     * @param \RocketChef\DataBundle\Entity\RecipeIngredient $recipes
     */
    public function removeRecipe(\RocketChef\DataBundle\Entity\RecipeIngredient $recipes)
    {
        $this->recipes->removeElement($recipes);
    }
}
