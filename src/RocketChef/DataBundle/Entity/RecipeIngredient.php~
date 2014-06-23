<?php
/**
 * User: floran
 * Date: 31/05/2014
 * Time: 16:22
 */

namespace RocketChef\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipeIngredient")
 */
class RecipeIngredient {

    const UNIT_UNITARY  = 0;
    const UNIT_KG       = 1;
    const UNIT_LITER    = 2;
    const UNIT_GR       = 3;
    const UNIT_CLITER   = 4;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ingredient", inversedBy="recipes", cascade={"persist"})
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="recipeIngredient", cascade={"persist"})
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $recipe;

    /**
     * @ORM\Column(type="integer")
     */
    protected $qte;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $unit;

    /**
     * @ORM\Column(type="float")
     */
    protected $cost = 0.0;


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
     * @param mixed $ingredient
     */
    public function setIngredient($ingredient)
    {
        $this->ingredient = $ingredient;
    }

    /**
     * @return mixed
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * @param mixed $qte
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    }

    /**
     * @return mixed
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param mixed $recipe
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
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



}
