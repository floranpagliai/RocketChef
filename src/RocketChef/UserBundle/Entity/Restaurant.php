<?php
/**
 * Restaurant.php
 * User: Utilisateur
 * Date: 10/06/14
 * Time: 13:50
 */

namespace RocketChef\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @var \RocketChef\UserBundle\Entity\Subscription
     * @ORM\ManyToOne(targetEntity="RocketChef\UserBundle\Entity\Subscription")
     */
    private $subscription;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="restaurant", cascade={"persist", "remove"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="RocketChef\DataBundle\Entity\Recipe", mappedBy="restaurant")
     */
    protected $recipes;

    /**
     * @ORM\OneToMany(targetEntity="RocketChef\DataBundle\Entity\Ingredient", mappedBy="restaurant")
     */
    protected $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="RocketChef\DataBundle\Entity\SellingDay", mappedBy="restaurant")
     */
    protected $sellingDays;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->recipes = new ArrayCollection();
        $this->sellingDays = new ArrayCollection();
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
     * @return ArrayCollection
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
     * @param mixed $sellingDays
     */
    public function setSellingDays($sellingDays)
    {
        $this->sellingDays = $sellingDays;
    }

    /**
     * @return mixed
     */
    public function getSellingDays()
    {
        return $this->sellingDays;
    }



    /**
     * Add users
     *
     * @param \RocketChef\UserBundle\Entity\User $users
     * @return Restaurant
     */
    public function addUser(\RocketChef\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \RocketChef\UserBundle\Entity\User $users
     */
    public function removeUser(\RocketChef\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Add recipes
     *
     * @param \RocketChef\DataBundle\Entity\Recipe $recipes
     * @return Restaurant
     */
    public function addRecipe(\RocketChef\DataBundle\Entity\Recipe $recipes)
    {
        $this->recipes[] = $recipes;

        return $this;
    }

    /**
     * Remove recipes
     *
     * @param \RocketChef\DataBundle\Entity\Recipe $recipes
     */
    public function removeRecipe(\RocketChef\DataBundle\Entity\Recipe $recipes)
    {
        $this->recipes->removeElement($recipes);
    }

    /**
     * Add ingredients
     *
     * @param \RocketChef\DataBundle\Entity\Ingredient $ingredients
     * @return Restaurant
     */
    public function addIngredient(\RocketChef\DataBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients[] = $ingredients;

        return $this;
    }

    /**
     * Remove ingredients
     *
     * @param \RocketChef\DataBundle\Entity\Ingredient $ingredients
     */
    public function removeIngredient(\RocketChef\DataBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients->removeElement($ingredients);
    }

    /**
     * @param \RocketChef\DataBundle\Entity\SellingDay $sellingDay
     * @return $this
     */
    public function addSellingDay(\RocketChef\DataBundle\Entity\SellingDay $sellingDay)
    {
        $this->sellingDays[] = $sellingDay;

        return $this;
    }

    /**
     * @param \RocketChef\DataBundle\Entity\SellingDay $sellingDay
     */
    public function removeSellingDay(\RocketChef\DataBundle\Entity\SellingDay $sellingDay)
    {
        $this->sellingDays->removeElement($sellingDay);
    }

    /**
     * @param \RocketChef\UserBundle\Entity\Subscription $subscription
     */
    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * @return \RocketChef\UserBundle\Entity\Subscription $subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }
}
