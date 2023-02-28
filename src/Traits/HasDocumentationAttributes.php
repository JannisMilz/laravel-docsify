<?php

namespace JannisMilz\Docsify\Traits;

trait HasDocumentationAttributes
{
  public $title;
  public $sidebar;
  public $version;
  public $content;
  public $docsRoute;
  public $sectionPage;
  public $defaultVersion;
  public $currentSection;
  public $statusCode = 200;
  public $publishedVersions;
  public $defaultVersionUrl;

  /**
   * @return string
   */
  public function getTitleAttribute()
  {
    return $this->title;
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
  public function getContentAttribute()
  {
    return $this->content;
  }

  /**
   * @return string
   */
  public function getCanonicalAttribute()
  {
    return $this->canonical;
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
  public function getCurrentSectionAttribute()
  {
    return $this->currentSection;
  }

  /**
   * @return int
   */
  public function getStatusCodeAttribute()
  {
    return $this->statusCode;
  }

  /**
   * @return string
   */
  public function getPublishedVersionsAttribute()
  {
    return $this->publishedVersions;
  }
}
