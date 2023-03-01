<?php

namespace JannisMilz\Docsify\Models;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Symfony\Component\DomCrawler\Crawler;
use JannisMilz\Docsify\Contracts\Cache;
use JannisMilz\Docsify\Traits\HasDocumentationAttributes;
use JannisMilz\Docsify\Traits\HasMarkdownParser;

class Documentation
{
  use HasMarkdownParser, HasDocumentationAttributes;

  /**
   * The filesystem implementation.
   *
   * @var Filesystem
   */
  protected $files;

  /**
   * The cache implementation.
   *
   * @var Cache
   */
  protected $cache;

  /**
   * Create a new documentation instance.
   *
   * @param Filesystem $files
   * @param Cache $cache
   */
  public function __construct(Filesystem $files, Cache $cache)
  {
    $this->files = $files;
    $this->cache = $cache;

    $this->defaultVersion = config('docsify.versions.default');
    $this->publishedVersions = config('docsify.versions.published');
  }

  /**
   * Get page in version
   */
  public function getVersionPage($version, $page = null)
  {
    return $this->cache->remember(function () use ($version, $page) {
      $path = base_path(config('docsify.docs.path') . '/' . $version . '/' . $page . '.md');

      if ($this->files->exists($path)) {
        $this->version = $version;
        $this->content = $this->parse($this->files->get($path));

        $this->getVersionSidebar($version);
        $this->preparePageTitle();

        return $this;
      }

      $this->statusCode = 404;
      return $this;
    }, 'docsify.docs.' . $version . '.' . $page);
  }

  /**
   * Get sidebar from version
   */
  public function getVersionSidebar($version)
  {
    return $this->cache->remember(function () use ($version) {
      $path = base_path(config('docsify.docs.path') . '/' . $version . '/sidebar.md');

      if ($this->files->exists($path)) {
        $this->sidebar = $this->parse($this->files->get($path));
        // $this->replaceLinks($version, $parsedContent);

        return $this;
      }

      return null;
    }, 'docsify.docs.' . $version . '.sidebar');
  }

  protected function preparePageTitle()
  {
    // First h1 tag is the page title
    $this->title = (new Crawler($this->content))->filterXPath('//h1');
    $this->title = count($this->title) ? $this->title->text() : config("docsify.docs.default_page_title");

    return $this;
  }

  /**
   * ------------------------------------------------------------------------
   */


  // /**
  //  * Get the documentation index page.
  //  *
  //  * @param  string  $version
  //  * @return string
  //  */
  // public function getIndex($version)
  // {
  //   return $this->cache->remember(function () use ($version) {
  //     $path = base_path(config('larecipe.docs.path') . '/' . $version . '/index.md');

  //     if ($this->files->exists($path)) {
  //       $parsedContent = $this->parse($this->files->get($path));

  //       return $this->replaceLinks($version, $parsedContent);
  //     }

  //     return null;
  //   }, 'larecipe.docs.' . $version . '.index');
  // }

  // /**
  //  * Get the given documentation page.
  //  *
  //  * @param $version
  //  * @param $page
  //  * @param array $data
  //  * @return mixed
  //  */
  // public function get($version, $page, $data = [])
  // {
  //   return $this->cache->remember(function () use ($version, $page, $data) {
  //     $path = base_path(config('larecipe.docs.path') . '/' . $version . '/' . $page . '.md');

  //     if ($this->files->exists($path)) {
  //       $parsedContent = $this->parse($this->files->get($path));

  //       $parsedContent = $this->replaceLinks($version, $parsedContent);

  //       return $this->renderBlade($parsedContent, $data);
  //     }

  //     return null;
  //   }, 'larecipe.docs.' . $version . '.' . $page);
  // }

  // /**
  //  * Replace the version and route placeholders.
  //  *
  //  * @param  string  $version
  //  * @param  string  $content
  //  * @return string
  //  */
  // public static function replaceLinks($version, $content)
  // {
  //   $content = str_replace('{{version}}', $version, $content);

  //   $content = str_replace('{{route}}', trim(config('larecipe.docs.route'), '/'), $content);

  //   $content = str_replace('"#', '"' . request()->getRequestUri() . '#', $content);

  //   return $content;
  // }

  // /**
  //  * Check if the given section exists.
  //  *
  //  * @param  string  $version
  //  * @param  string  $page
  //  * @return bool
  //  */
  // public function sectionExists($version, $page)
  // {
  //   return $this->files->exists(
  //     base_path(config('larecipe.docs.path') . '/' . $version . '/' . $page . '.md')
  //   );
  // }
}
