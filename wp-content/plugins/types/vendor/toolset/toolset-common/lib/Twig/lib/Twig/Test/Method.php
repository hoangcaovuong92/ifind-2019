<?php

namespace OTGS\Toolset;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use OTGS\Toolset\Twig\Extension\ExtensionInterface;
@\trigger_error('The Twig_Test_Method class is deprecated since version 1.12 and will be removed in 2.0. Use \\Twig\\TwigTest instead.', \E_USER_DEPRECATED);
/**
 * Represents a method template test.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class Twig_Test_Method extends \OTGS\Toolset\Twig_Test
{
    protected $extension;
    protected $method;
    public function __construct(\OTGS\Toolset\Twig\Extension\ExtensionInterface $extension, $method, array $options = [])
    {
        $options['callable'] = [$extension, $method];
        parent::__construct($options);
        $this->extension = $extension;
        $this->method = $method;
    }
    public function compile()
    {
        return \sprintf('$this->env->getExtension(\'%s\')->%s', \get_class($this->extension), $this->method);
    }
}
/**
 * Represents a method template test.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
/* class_alias removed from here because it becomes redundant with namespacing */
