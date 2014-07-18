<?php
/**
 * SellingDay.php
 * User: floran.pagliai
 * Date: 15/07/14
 * Time: 12:17
 */

namespace RocketChef\DataBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sellingDay")
 */
class SellingDay 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="date", unique=true)
     */
    protected $date;

    /**
     * @ORM\OneToMany(targetEntity="SellingDayRecipe", mappedBy="sellingDay", cascade={"persist"}, orphanRemoval=TRUE)
     * @Assert\Valid()
     */
    protected $recipes;

    /**
     * @ORM\ManyToOne(targetEntity="RocketChef\UserBundle\Entity\Restaurant", inversedBy="sellingDays")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
    protected $restaurant;

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

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
     * @param $recipes
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
} 