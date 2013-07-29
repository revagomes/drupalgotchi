<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Plugin\Action\PromoteNode.
 */

namespace Drupal\drupalgotchi\Plugin\Action;

use Drupal\Core\Annotation\Action;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Action\ActionBase;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Translation\TranslationManager;

/**
 * Sets the attention level of the site.
 *
 * @Action(
 *   id = "drupalgotchi_set_attention",
 *   label = @Translation("Sets the attention level of the site.")
 * )
 */
class SetDrupalgotchi extends ActionBase implements ContainerFactoryPluginInterface {

  /**
   * The state system.
   *
   * @var \Drupal\Core\KeyValueStore\KeyValueStoreInterface
   */
  protected $state;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, array $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('state')
    );
  }

  /**
   * Constructs a new DrupalgotchiBlock object.
   *
   * @param array $configuration
   * @param type $plugin_id
   * @param array $plugin_definition
   * @param \Drupal\Core\KeyValueStore\KeyValueStoreInterface $state
   *   The state service.
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The config factory service.
   */
  public function __construct(array $configuration, $plugin_id, array $plugin_definition, KeyValueStoreInterface $state, ConfigFactory $config_factory, TranslationManager $translation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->state = $state;
  }

  /**
   * {@inheritdoc}
   */
  public function execute($attention = 0) {
    $this->state->set('drupalgotchi.attention', $attention);
  }

}
