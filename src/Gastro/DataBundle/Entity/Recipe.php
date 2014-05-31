<?php
/**
 * User: floran
 * Date: 23/05/2014
 * Time: 00:43
 */

namespace Gastro\DataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Gastro\DataBundle\Entity\RecipeRepository")
 * @ORM\Table(name="recipe")
 * @ORM\HasLifecycleCallbacks
 */
class Recipe {

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
     * @var string $image
     * @Assert\File( maxSize = "1024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="RecipeIngredient", mappedBy="recipe", cascade={"persist"}, orphanRemoval=TRUE)
     */
    protected $recipeIngredients;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $portions;

    /**
     * @ORM\ManyToOne(targetEntity="Gastro\UserBundle\Entity\User", inversedBy="recipes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
     * Constructor
     */
    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
    }

    public function addIngredient(RecipeIngredient $ingredient)
    {
        if (!$this->recipeIngredients->contains($ingredient)) {
            $this->recipeIngredients->add($ingredient);
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function getRecipeIngredients()
    {
        return $this->recipeIngredients;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Recipe
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
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        if ($this->image != null)
            return 'upload/' . $this->id . '/' . $this->image;
        else
            return 'upload/test.jpg';
    }

    public function getFullImagePath() {
        return null === $this->image ? null : $this->getUploadRootDir(). $this->image;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }
        if(!$this->id){
            $this->image->move($this->getTmpUploadRootDir(), $this->image->getClientOriginalName());
        }else{
            $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        }
        $this->setImage($this->image->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist()
     */
    public function moveImage()
    {
        if (null === $this->image) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir().$this->image);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
        if ($this->image) {
            unlink($this->getFullImagePath());
            rmdir($this->getUploadRootDir());
        }
    }

    /**
     * @param mixed $portions
     */
    public function setPortions($portions)
    {
        $this->portions = $portions;
    }

    /**
     * @return mixed
     */
    public function getPortions()
    {
        return $this->portions;
    }


}
