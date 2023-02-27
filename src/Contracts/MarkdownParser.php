<?php

namespace JannisMilz\Docsify\Contracts;

use ParsedownExtra;

class MarkdownParser
{
    /**
     * Parse the given content to Markdown, using your Markdown parser of choice.
     *
     * @param string $content
     * @return null|string|string[]
     */
    public function parse($content) {
      return (new ParsedownExtra)->text($content);
    }
}
