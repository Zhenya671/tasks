<?php



class File
{

    private array $file = [];
    private string $name = '';
    private string $directory = 'upload';
    private int $maxSize = 5;
    private array $error = [] ;
    private array $type = ['png', 'jpeg', 'txt', 'jpg'];


    public function set(array $file): File
    {

        $this->file = $file;

        return $this;

    }

    public function diskFreeCheck(array $file): File
    {

        if (disk_free_space('/') < $file['size']) {

            $this->error[] = 'low memory to upload file';

        }

        return $this;

    }

    public function getError(): ?array
    {
            foreach ($this->error as $error){
                if ($error == '') {
                    return null;
                }
            }
            return $this->error;

    }

    public function showInfo()
    {

        echo 'size : ' . $_FILES['upload']['size'] / 1000 . 'kb' . '<br>';
        echo 'name : ' . $this->name . '<br>';

        $partsOfString = explode('.', $this->file['name']);
        $typeOfFile = array_pop($partsOfString);

        $fileRead = fopen("$this->directory/$this->name.$typeOfFile", 'rb');
        $headers = @exif_read_data($fileRead);



        if ($headers !== false) {
            echo 'Metadata are : ';
            foreach ($headers as $header => $value) {
                echo '<br>';
                printf(' %s => %s%s', $header, $value, PHP_EOL);

            }
            foreach ($headers['COMPUTED'] as $header2 => $value2) {
                echo '<br>';
                printf(' %s => %s%s', $header2, $value2, PHP_EOL);
            }

        }

    }

    public function executableType(): File
    {

        if (is_executable($this->file['tmp_name'])) {

            $this->error[] = 'error: executable file';

            return $this;

        }

        return $this;


    }

    public function type(): File
    {
        $typeCheck = explode('.', $this->file['name']);

        foreach ($typeCheck as $value) {

            if (in_array($value, $this->type)) {

                return $this;

            }
        }
        $this->error[] = 'invalid type';
        return $this;

    }

    public function name(string $name): File
    {

        $this->name = $name;

        return $this;

    }

    public function maxSize(int $size): File
    {
        if ($size > 0) {

            $this->maxSize = $size * 1024 * 1024;

        } else {
            $this->error[] = "maximum upload file must be integer and greater than zero";
        }

        return $this;
    }

    public function directory(string $directory): File
    {
        $this->directory = $directory;
        return $this;
    }

    public function getExtension(): string
    {

        $fileName = explode('.', $this->file['name']);
        return end($fileName);

    }

    public function getSize()
    {

        return $this->file['size'];

    }

    public function getDirectory(): string
    {
        if (!is_dir($this->directory)) {

            @mkdir($this->directory); //use @ because without @ function mkdir throw warning

        }

        return $this->directory;
    }

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

    public function destination(): string
    {

        $directoryD = $this->getDirectory() . DIRECTORY_SEPARATOR;
        $directoryD .= $this->getName();
        $directoryD .= '.' . $this->getExtension();

        return $directoryD;

    }

    public function upload(): bool
    {
        if ($this->maxSize < $this->getSize()) {
            $this->error[] = 'File size is ' . round($this->getSize(), 2) . "<br> maximum to upload is "
                . round($this->maxSize, 2);
        }
        if (empty($this->error)) {
            return move_uploaded_file($this->file['tmp_name'], $this->destination());
        } else {
            Logger::file($this->getError(), $this->file);
            return false;
        }
    }

    public function report()
    {
        foreach ($this->error as $value) {

            echo "$value<br>";

        }

    }

}