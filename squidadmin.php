<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class SquidadminPlugin
 * @package Grav\Plugin
 */
class SquidAdminPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized() {
        if ($this->isAdmin()) {
            $this->initializeAdmin();
        }
    }

    public function initializeAdmin() {
        $uri = $this->grav['uri'];
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigAdminTemplatePaths', 0]
        ]);
    }

    public function onTwigAdminTemplatePaths() {
        $pluginsobject = (array) $this->config->get('plugins');
        if (isset($pluginsobject['squidadmin'])) {
            if ($pluginsobject['squidadmin']['enabled']) {
                $this->grav['twig']->twig_paths[] = __DIR__ . '/admin/templates';
                $this->grav['debugger']->addMessage('Squid taste rubber 2');
                dump ($this->grav['twig']->twig_paths);
            }
        }
    }
}
