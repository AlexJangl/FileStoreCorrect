<?php
namespace FileStore;

use Iterator;


class IteratorFile implements Iterator
{
    protected $file;
    protected $index;
    protected $currentLine = null;
    protected $columnName;
    protected $columns;


    public function __construct($filename, $columnName = true)
    {
        if(file_exists($filename)) {
            $this->file = fopen($filename, 'r');
            $this->columnName = $columnName;
        } else {
            throw new \Exception('File do not exists.');
        }
    }

    public function current()
    {
        return $this->currentLine;
    }

    public function next()
    {
        $this->fetchLine();
        $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return !feof($this->file) || !is_null($this->currentLine);
    }

    public function rewind()
    {
        rewind($this->file);
        if ($this->columnName)
        {
            $this->columns = fgetcsv($this->file);
        }
        else
        {
            $this->columns = [];
        }
        $this->index = 0;
        $this->fetchLine();
    }

    public function fetchLine()
    {
        $values = fgetcsv($this->file);
        if(is_array($values))
        {
            if ($this->columnName)
            {
                $this->currentLine = array_combine($this->columns, $values);
            }
            else
            {
                $this->currentLine = $values;
            }
        }
        else
        {
            $this->currentLine = null;
        }
    }
}