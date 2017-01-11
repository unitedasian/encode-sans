<?php

namespace UAM\Font\EncodeSans\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * EncodeSans bundle extension.
 *
 * @author     Olivier Pichon <op@united-asian.com>
 * @copyright  2016 Olivier Pichon
 */
class EncodeSansExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        if (true === isset($bundles['AsseticBundle'])) {

            switch ($config['mode']) {
                case Configuration::MODE_FAMILIES :
                    $this->configureFontFamilies($container);
                    break;

                case Configuration:MODE_INDIVIDUAL :
                    $this->configureIndividualFonts();
//                    $this->configureEncodeSans();
//                    $this->configureEncodeSansCompressed($container);
//                    $this->configureEncodeSansCondensed($container);
//                    $this->configureEncodeSansNarrow($container);
//                    $this->configureEncodeSansWide($container);
                    break;
            }
        }
    }

    protected function configureFontFamilies($container)
    {
        $assets = array();

        foreach ($this->getWidths() as $width) {
            if ('normal' == $width) {
                $name = 'encode_sans';
                $stylesheet = 'bundles/encodesans/css/encode-sans.css';
            } else {
                $name = 'encode_sans_'.$width;
                $stylesheet = 'bundles/encodesans/css/encode-sans-'.$width.'.css';
            }

            $assets[$name] = array(
                'inputs' => array(
                    $stylesheet,
                ),
            );
        }

        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => $assets,
            )
        );
    }

    protected function configureIndividualFonts()
    {
        $assets = array();

        foreach ($this->getWidths() as $width) {
            $assets = array_merge(
                $assets,
                $this->getFontAssets($width)
            );
        }

        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => $assets,
            )
        );
    }

    protected function getFontAssets($width)
    {
        $assets = array();

        foreach ($this->getWeights() as $weight) {
            $name = sprintf(
                'encode_sans_%s_%s',
                $width,
                $weight
            );

            $stylesheet = sprintf(
                'bundles/encodesans/css/%s/encode-sans-%s-%s.css',
                $width,
                $width,
                $weight
            );

            $assets[$name] = array(
                'inputs' => array(
                    $stylesheet,
                ),
            );
        }

        return $assets;
    }

    protected function getWidths()
    {
        return array(
            'normal',
            'narrow',
            'condensed',
            'compressed',
            'wide',
        );
    }

    protected function getWeights()
    {
        return array(
            'regular',
            'medium',
            'semibold',
            'bold',
            'extrabold',
            'black',
            'light',
            'extralight',
            'thin',
        );
    }
}