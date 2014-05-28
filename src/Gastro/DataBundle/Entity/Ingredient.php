<?php
/**
 * User: floran
 * Date: 23/05/2014
 * Time: 00:02
 */

namespace Gastro\DataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Gastro\DataBundle\Entity\IngredientRepository")
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
     * @ORM\Column(type="decimal")
     */
    protected $priceByUnit;

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
     * @ORM\ManyToMany(targetEntity="Recipe", inversedBy="ingredients", cascade={"persist"})
     * @ORM\JoinTable(name="ingredients_recipes")
     **/
    protected $recipes;

    /**
     * Constructor
     */
    public function __construct()
    {
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
    public function setPriceByUnit($priceByUnit)
    {
        $this->priceByUnit = $priceByUnit;

        return $this;
    }

    /**
     * Get priceByUnit
     *
     * @return string 
     */
    public function getPriceByUnit()
    {
        return $this->priceByUnit;
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

    /**
     * Add recipes
     *
     * @param \Gastro\DataBundle\Entity\Recipe $recipes
     * @return Ingredient
     */
    public function addRecipe(\Gastro\DataBundle\Entity\Recipe $recipes)
    {
        $this->recipes[] = $recipes;

        return $this;
    }

    /**
     * Remove recipes
     *
     * @param \Gastro\DataBundle\Entity\Recipe $recipes
     */
    public function removeRecipe(\Gastro\DataBundle\Entity\Recipe $recipes)
    {
        $this->recipes->removeElement($recipes);
    }

    /**
     * Get recipes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}
