<?php

namespace JannisMilz\Docsify\Traits;

trait HasDocumentationAttributes
{
  public $title;
  public $content;
  public $sidebar;
  public $version;
  public $defaultVersion;
  public $publishedVersions;
  public $statusCode = 200;

  /**
   * @return string
   */
  public function getTitleAttribute()
  {
    return $this->title;
  }

  /**
   * @return string
   */
  public function getContentAttribute()
  {
    return $this->content;
  }

  /**
   * @return mixed
   */
  public function getSidebarAttribute()
  {
    return $this->sidebar;
  }

  /**
   * @return string
   */
  public function getVersionAttribute()
  {
    return $this->version;
  }

  /**
   * @return string
   */
  public function getDefaultVersionUrlAttribute()
  {
    return $this->defaultVersionUrl;
  }

  /**
   * @return string
   */
  public function getPublishedVersionsAttribute()
  {
    return $this->publishedVersions;
  }

  /**
   * @return int
   */
  public function getStatusCodeAttribute()
  {
    return $this->statusCode;
  }
}
