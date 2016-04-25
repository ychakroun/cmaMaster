<?php
namespace CmaUserBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $name;
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $path;
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    private $temp;
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * Set name.
     *
     * @param String $name
     */
    public function setName($name)
    {
        return $this->name = $name;
    }
    /**
     *  getName.
     * @return getName
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            if($this->name!=null){
                 $this->path = $this->name.'/'.$filename.'.'.$this->getFile()->guessExtension();
             }else{
                $this->path = $filename.'.'.$this->getFile()->guessExtension();
             }
        }
    }
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/images/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        if (!file_exists(__DIR__.'/../../../web/images/'.$this->name)) {
            mkdir(__DIR__.'/../../../web/images/'.$this->name, 0755, true);
        }
        return $this->name;
    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            if(unlink(__DIR__.'/../../../web/images/'.$this->temp));
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }
    /**
     * @ORM\PreRemove()
     */
    public function removeUpload()
    {
        $updloadDir = $this->getAbsolutePath();
        $chmod = $updloadDir.substr($this->path, 0,strpos($this->path,'/'));
        $file = $this->path;
        if ($file) {
            //chmod($chmod,0777);
            unlink($updloadDir.$file);
            //chmod($chmod,0755);
        }
    }
    public function getAbsolutePath(){

        return __DIR__.'/../../../web/images/';
    }

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
     * Set path
     *
     * @param string $path
     *
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
