<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace System\Libraries\Dom\CssSelector\Parser\Handler;

use System\Libraries\Dom\CssSelector\Parser\Reader;
use System\Libraries\Dom\CssSelector\Parser\Token;
use System\Libraries\Dom\CssSelector\Parser\TokenStream;
use System\Libraries\Dom\CssSelector\Parser\Tokenizer\TokenizerEscaping;
use System\Libraries\Dom\CssSelector\Parser\Tokenizer\TokenizerPatterns;

/**
 * CSS selector comment handler.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class HashHandler implements HandlerInterface
{

    /**
     * @var TokenizerPatterns
     */
    private $patterns;

    /**
     * @var TokenizerEscaping
     */
    private $escaping;

    /**
     * @param TokenizerPatterns $patterns
     * @param TokenizerEscaping $escaping
     */
    public function __construct(TokenizerPatterns $patterns, TokenizerEscaping $escaping)
    {
        $this->patterns = $patterns;
        $this->escaping = $escaping;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Reader $reader, TokenStream $stream)
    {
        $match = $reader->findPattern($this->patterns->getHashPattern());

        if (!$match)
        {
            return false;
        }

        $value = $this->escaping->escapeUnicode($match[1]);
        $stream->push(new Token(Token::TYPE_HASH, $value, $reader->getPosition()));
        $reader->moveForward(strlen($match[0]));

        return true;
    }

}
