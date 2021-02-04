<?php

namespace App\Entity;

use App\Repository\EnvironmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=EnvironmentRepository::class)
 */
class Environment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $branch;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $releasePrefix;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $updatePrefix;

    /**
     * @ORM\OneToMany(targetEntity=PhpVersion::class, mappedBy="Enviroment")
     */
    private $phpVersions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bintrayPackageUrl;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $packageRepository;

    public function __construct()
    {
        $this->phpVersions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReleasePrefix(): ?string
    {
        return $this->releasePrefix;
    }

    public function setReleasePrefix(string $releasePrefix): self
    {
        $this->releasePrefix = $releasePrefix;

        return $this;
    }

    public function getUpdatePrefix(): ?string
    {
        return $this->updatePrefix;
    }

    public function setUpdatePrefix(string $updatePrefix): self
    {
        $this->updatePrefix = $updatePrefix;

        return $this;
    }

    public function getBranch(): ?string
    {
        return $this->branch;
    }

    public function setBranch(string $branch): self
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * @return Collection|PhpVersion[]
     */
    public function getPhpVersions(): Collection
    {
        return $this->phpVersions;
    }

    public function addPhpVersion(PhpVersion $phpVersion): self
    {
        if (!$this->phpVersions->contains($phpVersion)) {
            $this->phpVersions[] = $phpVersion;
            $phpVersion->setEnviroment($this);
        }

        return $this;
    }

    public function removePhpVersion(PhpVersion $phpVersion): self
    {
        if ($this->phpVersions->removeElement($phpVersion)) {
            // set the owning side to null (unless already changed)
            if ($phpVersion->getEnviroment() === $this) {
                $phpVersion->setEnviroment(null);
            }
        }

        return $this;
    }

    public function getBintrayPackageUrl(): ?string
    {
        return $this->bintrayPackageUrl;
    }

    public function setBintrayPackageUrl(string $bintrayPackageUrl): self
    {
        $this->bintrayPackageUrl = $bintrayPackageUrl;

        return $this;
    }

    public function getPackageRepository(): ?string
    {
        return $this->packageRepository;
    }

    public function setPackageRepository(string $packageRepository): self
    {
        $this->packageRepository = $packageRepository;

        return $this;
    }
}
