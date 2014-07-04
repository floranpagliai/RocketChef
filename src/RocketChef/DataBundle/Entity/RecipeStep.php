<?php
/**
 * RecipeStep.php
 * User: floran.pagliai
 * Date: 04/07/14
 * Time: 12:05
 */

namespace RocketChef\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipeStep")
 */
class RecipeStep 
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="recipeStep", cascade={"persist"})
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $recipe;

    /**
     * @ORM\Column(type="string")
     */
    protected $text;

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
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }
} 