<?php
/**
 * Restaurant.php
 * User: Utilisateur
 * Date: 10/06/14
 * Time: 13:50
 */

namespace Gastro\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="restaurant")
 * @ORM\Entity()
 */
class Restaurant
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="restaurant")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Gastro\DataBundle\Entity\Recipe", mappedBy="restaurant")
     */
    protected $recipes;

    /**
     * @ORM\OneToMany(targetEntity="Gastro\DataBundle\Entity\Ingredient", mappedBy="restaurant")
     */
    protected $ingredients;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
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
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
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
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }



    /**
     * Add users
     *
     * @param \Gastro\UserBundle\Entity\User $users
     * @return Restaurant
     */
    public function addUser(\Gastro\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Gastro\UserBundle\Entity\User $users
     */
    public function removeUser(\Gastro\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Add recipes
     *
     * @param \Gastro\DataBundle\Entity\Recipe $recipes
     * @return Restaurant
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
     * Add ingredients
     *
     * @param \Gastro\DataBundle\Entity\Ingredient $ingredients
     * @return Restaurant
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
}
