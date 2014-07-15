<?php
/**
 * SellingDayRecipe.php
 * User: floran.pagliai
 * Date: 15/07/14
 * Time: 12:19
 */

namespace RocketChef\DataBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sellingDayRecipe")
 */
class SellingDayRecipe 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe", cascade={"persist"})
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $recipe;

    /**
     * @ORM\ManyToOne(targetEntity="SellingDay", inversedBy="recipe", cascade={"persist"})
     * @ORM\JoinColumn(name="sellingday_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $sellingDay;

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
     * @param mixed $sellingDay
     */
    public function setSellingDay($sellingDay)
    {
        $this->sellingDay = $sellingDay;
    }

    /**
     * @return mixed
     */
    public function getSellingDay()
    {
        return $this->sellingDay;
    }
} 