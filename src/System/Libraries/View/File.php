<?php

namespace System\Libraries\View;

use ArrayObject;
use ArrayAccess;
use Exception;
use System\Libraries\View\Exception\ErrorException;

/**
 * @property-read string $file
 * @property-read array $data
 */
class File implements ArrayAccess
{

    /** @var ArrayObject */
    protected static $globals = null;

    /** @var string */
    protected $file = '';

    /** @var array */
    protected $data = [];

    /**
     * 
     * @param string $file
     * @param array $data
     * @throws \RuntimeException
     */
    public function __construct($file, $data = [])
    {
        $this->file = $file;
        $this->data = $data;
    }

    /**
     * 
     * @param string $html
     * @return string
     */
    protected function replaceTemplateTags($html)
    {
        $pattern = "#\{{2}\s*([^{}\s]+)\s*\}{2}#";
        $replace = '<?= (isset($$1)) ? $$1 : "<em>NULL</em>" ?>';
        return preg_replace($pattern, $replace, $html);
    }

    /**
     * 
     * @return string
     */
    public function render()
    {
        foreach (array_merge((array) $this->globals(), (array) $this->data) as $variable => $value)
        {
            $$variable = $value;
        }

        ob_start();

        try
        {
            eval("?> {$this->replaceTemplateTags(file_get_contents($this->file))}");
        }
        catch (Exception $ex)
        {
            throw new ErrorException($ex->getMessage(), $ex->getCode());
        }

        return ob_get_clean();
    }

    /**
     * 
     * @return ArrayObject
     */
    public function globals()
    {
        if (!(self::$globals instanceof ArrayObject))
        {
            self::$globals = new ArrayObject();
        }
        return self::$globals;
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

}
