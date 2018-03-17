<?php

namespace DAW\pepeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Articles
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DAW\pepeBundle\Entity\ArticlesRepository")
 */
class Articles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", Type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", Type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", Type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", Type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", Type="string", length=255)
     */
    private $tags;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", Type="date")
     * @Assert\NotNull(message="El articulo debe tener una fecha de creacion")
     *
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", Type="date")
     *
     *
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", Type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="category", Type="string", length=255)
     */
    private $category;


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
     * Set title
     *
     * @param string $title
     * @return Articles
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Articles
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Articles
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Articles
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    
        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Articles
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Articles
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Articles
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Articles
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }


    //FK RELATION Comment->article
    /**
     * @ORM\OneToMany(targetEntity="Comments", mappedBy="article")
     */
    private $comments;
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function addComments(Comments $comments)
    {
        $this->comments[] = $comments;
    }
    public function SetComments(\Doctrine\Common\Collections\ArrayCollection $comments)
    {
        $this->comments[] = $comments;
        return $this;
    }

    public function getComments()
    {
        return $this->comments;
    }
}
