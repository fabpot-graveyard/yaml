<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/lime/lime.php');

class lime_symfony extends lime_harness
{
  protected function get_relative_file($file)
  {
    $file = str_replace(DIRECTORY_SEPARATOR, '/', str_replace(array(
      realpath($this->base_dir).DIRECTORY_SEPARATOR,
      realpath($this->base_dir.'/../lib/plugins').DIRECTORY_SEPARATOR,
      $this->extension,
    ), '', $file));

    return preg_replace('#^(.*?)Plugin/test/(unit|functional)/#', '[$1] $2/', $file);
  }
}

$h = new lime_symfony(new lime_output(isset($argv) && in_array('--color', $argv)));
$h->base_dir = realpath(dirname(__FILE__).'/..');

$h->register(array(
  dirname(__FILE__).'/sfYamlInlineTest.php',
  dirname(__FILE__).'/sfYamlDumperTest.php',
  dirname(__FILE__).'/sfYamlParserTest.php',
));

exit($h->run() ? 0 : 1);
