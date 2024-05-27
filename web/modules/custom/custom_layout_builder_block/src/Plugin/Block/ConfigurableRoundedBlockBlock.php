<?php

declare(strict_types=1);

namespace Drupal\custom_layout_builder_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a configurable rounded block block.
 *
 * @Block(
 *   id = "custom_layout_builder_block_configurable_rounded_block",
 *   admin_label = @Translation("Configurable Rounded Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class ConfigurableRoundedBlockBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array
  {
    return [
      'title' => 'Default Title',
      'content' => [
        'value' => 'Block content here',
        'format' => 'basic_html',
      ],
      'cta_text' => '',
      'cta_link' => ''
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state): array
  {
    $config = $this->getConfiguration();

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' =>$config['title'],
    ];

    $form['content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $config['content']['value'],
      '#format' => $config['content']['format'],
    ];

    $form['cta_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CTA Text'),
      '#default_value' => $config['cta_text'],
    ];

    $form['cta_link'] = [
      '#type' => 'url',
      '#title' => $this->t('CTA Link'),
      '#default_value' => $config['cta_link'],
    ];

    $form['fade_in'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Fade In'),
      '#default_value' => $config['fade_in'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state): void
  {
    $this->setConfigurationValue('title',    $form_state->getValue('title'));
    $this->setConfigurationValue('content',  $form_state->getValue('content'));
    $this->setConfigurationValue('cta_text', $form_state->getValue('cta_text'));
    $this->setConfigurationValue('cta_link', $form_state->getValue('cta_link'));
    $this->setConfigurationValue('fade_in',  $form_state->getValue('fade_in'));
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array
  {
    $config = $this->getConfiguration();
    $build['content'] = [
      '#markup' => $config['content']['value'],
    ];
    return $build;
  }

}
