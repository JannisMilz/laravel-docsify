<?php

namespace JannisMilz\Docsify\Traits;

use Illuminate\Support\Facades\App;
use JannisMilz\Docsify\Contracts\MarkdownParser;

trait HasMarkdownParser
{
    /**
     * @param $content
     * @return null|string|string[]
     * @throws \Exception
     */
    public function parse($content)
    {
        return App::make(MarkdownParser::class)->parse($content);
    }
}
