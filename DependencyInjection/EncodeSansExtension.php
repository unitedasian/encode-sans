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

        /*

        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => array(
                    'encode_sans' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans.css',
                        ),
                    ),
                    'encode_sans_compressed' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-compressed.css',
                        ),
                    ),
                    'encode_sans_condensed' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-all.css',
                        ),
                    ),
                    'encode_sans_narrow' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-all.css',
                        ),
                    ),
                    'encode_sans_wide' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-all.css',
                        ),
                    ),
                ),
            )
        );
        */
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

    protected function configureEncodeSans($container)
    {
        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => array(
                    'encode_sans_regular' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-regular.css',
                        ),
                    ),
                    'encode_sans_medium' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-medium.css',
                        ),
                    ),
                    'encode_sans_semibold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-semibold.css',
                        ),
                    ),
                    'encode_sans_bold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-bold.css',
                        ),
                    ),
                    'encode_sans-extrabold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-extrabold.css',
                        ),
                    ),
                    'encode_sans_black' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-black.css',
                        ),
                    ),
                    'encode_sans_light' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-light.css',
                        ),
                    ),
                    'encode_sans_extralight' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-extralight.css',
                        ),
                    ),
                    'encode_sans_thin' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/encode-sans-thin.css',
                        ),
                    ),
                ),
            )
        );
    }

    protected function configureEncodeSansCompressed($container)
    {
        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => array(
                    'encode_sans_compressed_regular' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-regular.css',
                        ),
                    ),
                    'encode_sans_compressed_medium' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-medium.css',
                        ),
                    ),
                    'encode_sans_compressed_semibold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-semibold.css',
                        ),
                    ),
                    'encode_sans_compressed_bold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-bold.css',
                        ),
                    ),
                    'encode_sans_compressed_extrabold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-extrabold.css',
                        ),
                    ),
                    'encode_sans_compressed_black' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-black.css',
                        ),
                    ),
                    'encode_sans_compressed_light' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-light.css',
                        ),
                    ),
                    'encode_sans_compressed_extralight' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-extralight.css',
                        ),
                    ),
                    'encode_sans_compressed_thin' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/compressed/encode-sans-compressed-thin.css',
                        ),
                    ),
                ),
            )
        );
    }

    protected function configureEncodeSansCondensed($container)
    {
        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => array(
                    'encode-sans-condensed-regular' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-regular.css',
                        ),
                    ),
                    'encode-sans-condensed-medium' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-medium.css',
                        ),
                    ),
                    'encode-sans-condensed-semibold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-semibold.css',
                        ),
                    ),
                    'encode-sans-condensed-bold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-bold.css',
                        ),
                    ),
                    'encode-sans-condensed-extrabold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-extrabold.css',
                        ),
                    ),
                    'encode-sans-condensed-black' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-black.css',
                        ),
                    ),
                    'encode-sans-condensed-light' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-light.css',
                        ),
                    ),
                    'encode-sans-condensed-extralight' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-extralight.css',
                        ),
                    ),
                    'encode-sans-condensed-thin' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/condensed/encode-sans-condensed-thin.css',
                        ),
                    ),
                ),
            )
        );
    }

    protected function configureEncodeSansNarrow($container)
    {
        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => array(
                    'encode-sans-narrow-regular' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-regular.css',
                        ),
                    ),
                    'encode-sans-narrow-medium' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-medium.css',
                        ),
                    ),
                    'encode-sans-narrow-semibold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-semibold.css',
                        ),
                    ),
                    'encode-sans-narrow-bold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-bold.css',
                        ),
                    ),
                    'encode-sans-narrow-extrabold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-extrabold.css',
                        ),
                    ),
                    'encode-sans-narrow-black' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-black.css',
                        ),
                    ),
                    'encode-sans-narrow-light' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-light.css',
                        ),
                    ),
                    'encode-sans-narrow-extralight' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-extralight.css',
                        ),
                    ),
                    'encode-sans-narrow-thin' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/narrow/encode-sans-narrow-thin.css',
                        ),
                    ),
                ),
            )
        );
    }

    protected function configureEncodeSansWide($container)
    {
        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => array(
                    'encode-sans-wide-regular' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-regular.css',
                        ),
                    ),
                    'encode-sans-wide-medium' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-medium.css',
                        ),
                    ),
                    'encode-sans-wide-semibold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-semibold.css',
                        ),
                    ),
                    'encode-sans-wide-bold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-bold.css',
                        ),
                    ),
                    'encode-sans-wide-extrabold' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-extrabold.css',
                        ),
                    ),
                    'encode-sans-wide-black' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-black.css',
                        ),
                    ),
                    'encode-sans-wide-light' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-light.css',
                        ),
                    ),
                    'encode-sans-wide-extralight' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-extralight.css',
                        ),
                    ),
                    'encode-sans-wide-thin' => array(
                        'inputs' => array(
                            'bundles/encodesans/css/wide/encode-sans-wide-thin.css',
                        ),
                    ),
                ),
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