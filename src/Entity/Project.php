<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string $description
     *
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Un logo est nécessaire pour ce projet")
     * @Assert\File(mimeTypes={ "image/gif", "image/jpeg", "image/png", "image/svg+xml" })
     */
    private $logo;

    /**
     * @var string $website
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string $github
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    /**
     * @var string $gitlab
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gitlab;

    /**
     * @var ArrayCollection $tags
     *
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param $logo
     */
    public function setLogo($logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getGithub(): ?string
    {
        return $this->github;
    }

    /**
     * @param string $github
     */
    public function setGithub(string $github): void
    {
        $this->github = $github;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(): ?ArrayCollection
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection $tags
     */
    public function setTags(ArrayCollection $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getGitlab(): ?string
    {
        return $this->gitlab;
    }

    /**
     * @param string $gitlab
     */
    public function setGitlab(string $gitlab): void
    {
        $this->gitlab = $gitlab;
    }

}
