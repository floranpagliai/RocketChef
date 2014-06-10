<?php
/**
 * Restaurant.php
 * User: Utilisateur
 * Date: 10/06/14
 * Time: 13:50
 */

namespace Gastro\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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

    public function __construct()
    {
        $this->users = new ArrayCollection();
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


} 