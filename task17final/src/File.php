<?php

namespace App;

/**
 *  class File implement handler for the upload file
 */
class File
{
    /**
     * consist properties about upload file
     *
     * @var array
     */
    private array $file = [];

    /**
     * name of file which will change to uploading file in directory
     *
     * @var string
     */
    private string $name = '';

    /**
     * default name of directory which will uploading file
     *
     * @var string
     */
    private string $directory = 'upload';

    /**
     * default maximum size for upload file
     *
     * @var int
     */
    private int $maxSize = 5;

    /**
     * types for file which will uploading
     *
     * @var array|string[]
     */
    private array $type = ['png', 'jpeg', 'txt', 'jpg'];


    /**
     * set file properties
     *
     * @param array $file file properties
     * @return $this
     */
    public function set(array $file): File
    {
        $this->file = $file;
        return $this;

    }

    /**
     * check disk memory for upload file
     *
     * @param array $file file properties
     * @return $this
     * @throws FileUploadException
     */
    public function diskFreeCheck(array $file): File
    {

        if (disk_free_space('/') < $file['filesize']) {
            throw new FileUploadException('low memory to upload file');
        }

        return $this;

    }

    /**
     * check executable file type
     *
     * @return $this
     * @throws FileUploadException
     */
    public function executableType(): File
    {
        if (is_executable($this->file['tmp_name'])) {
            throw new FileUploadException('error: executable file');
        }

        return $this;


    }

    /**
     * check upload file type
     *
     * @return $this
     * @throws FileUploadException
     */
    public function type(): File
    {
        $typeCheck = explode('/', $this->file['typeFile']);
        if (!in_array($typeCheck[1], $this->type)) {
            throw new FileUploadException('invalid type');
        }

        return $this;

    }

    /**
     * check for nonempty send form
     *
     * @return $this
     * @throws FileUploadException
     */
    public function notEmpty(): File
    {
        if ($this->file['filesize'] <= 0) {
            throw new FileUploadException('not select file');
        }
        return $this;
    }

    /**
     * set new name for upload file
     *
     * @param string $name
     * @return $this
     */
    public function name(string $name): File
    {

        $this->name = $name;

        return $this;

    }

    /**
     * set maximum size for upload file
     *
     * @param int $size
     * @return $this
     * @throws FileUploadException
     */
    public function maxSize(int $size): File
    {
        if ($size > 0) {

            $this->maxSize = $size * 1024 * 1024;

        } else {
            throw new FileUploadException('maximum upload file must be integer and greater than zero');
        }


        return $this;
    }

    /**
     * set directory for upload file
     *
     * @param string $directory
     * @return $this
     */
    public function directory(string $directory): File
    {
        $this->directory = $directory;

        return $this;
    }

    /**
     * return file type
     *
     * @return string
     */
    public function getExtension(): string
    {

        $endType = explode('/', $this->file['typeFile']);
        return end($endType);

    }

    /**
     * return file size
     *
     * @return mixed
     */
    public function getSize()
    {

        return $this->file['filesize'];

    }

    /**
     * if directory is not exist, create directory
     * and return name of directory
     *
     * @return string
     */
    public function getDirectory(): string
    {

        if (!is_dir($this->directory)) {

            @mkdir($this->directory); //use @ because without @ function mkdir throw warning

        }

        return $this->directory;
    }

    /**
     * return new name of file
     *
     * @return string
     */
    public function getName(): string
    {
        if (empty($this->name)) {
            $this->name = date("YmdHis");
        }

        $fileC = $this->getDirectory() . DIRECTORY_SEPARATOR . $this->name
            . "." . $this->getExtension();

        if (file_exists($fileC)) {

            $i = 0;

            do {
                $this->name .= $i;
                $fileC = $this->getDirectory() . DIRECTORY_SEPARATOR . $this->name
                    . "." . $this->getExtension();
                $i++;
            } while (file_exists($fileC));

        }

        return $this->name;

    }

    /**
     * @return string
     */
    public function destination(): string
    {

        $directoryD = $this->getDirectory() . DIRECTORY_SEPARATOR;
        $directoryD .= $this->getName();
        $directoryD .= '.' . $this->getExtension();

        return $directoryD;

    }

    /**
     * method implement saving file in directory
     *
     * @return bool
     * @throws FileUploadException
     */
    public function upload(): bool
    {
        if ($this->maxSize < $this->getSize()) {
            throw new FileUploadException("File size is " . round($this->getSize(), 2) . "<br> maximum to upload is "
                . round($this->maxSize, 2));
        }

        return move_uploaded_file($this->file['tmp_name'], $this->destination());

    }

}