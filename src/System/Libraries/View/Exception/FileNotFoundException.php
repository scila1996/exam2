<?php

namespace System\Libraries\View\Exception;

use Exception;

class FileNotFoundException extends Exception
{

    /**
     * @param string $path The path to the file that was not found
     */
    public function __construct($path)
    {
        parent::__construct(sprintf('The file "%s" does not exist', $path));
    }

}
