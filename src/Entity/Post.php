<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

    #[ORM\Entity(repositoryClass:PostRepository::class)]
    #[ORM\HasLifecycleCallbacks()]

class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\ManyToOne(targetEntity:User::class, inversedBy:"posts")]
    #[ORM\JoinColumn(nullable:false)]
    
    private $user;

    #[ORM\Column(type:"text")]
     
    private $content;

    #[ORM\Column(type:"datetime")]
    
    private $createdAt;

    #[ORM\Column(type:"datetime", nullable:true)]
    
    private $updatedAt;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post')]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * Je récupère l'identifiant du post.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Je récupère l'utilisateur qui a créé ce post.
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Je définis l'utilisateur qui a créé ce post.
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Je récupère le contenu du post.
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Je définis le contenu du post.
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Je récupère la date de création du post.
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Je définis la date de création du post.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Je récupère la date de la dernière mise à jour du post.
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Je définis la date de la dernière mise à jour du post.
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }

   
}
