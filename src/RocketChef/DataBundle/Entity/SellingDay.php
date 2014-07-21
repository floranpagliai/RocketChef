<?php
/**
 * SellingDay.php
 * User: floran.pagliai
 * Date: 15/07/14
 * Time: 12:17
 */

namespace RocketChef\DataBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sellingDay")
 * @UniqueEntity("date", message="selling.warn.dateUnique")
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
     */
    protected $recipes;

    /**
     * @ORM\ManyToOne(targetEntity="RocketChef\UserBundle\Entity\Restaurant", inversedBy="sellingDays")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
    protected $restaurant;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }
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

    public function addRecipes(Recipe $recipe)
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
        }
        return $this;
    }

    public function removeRecipes(Recipe $recipe)
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
        }
        return $this;
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
} 