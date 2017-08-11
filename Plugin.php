<?php 

namespace JD\Twigs;

use Backend;
use Cms\Classes\Theme;
use Cms\Classes\Content;
use System\Classes\PluginBase;

/**
 * Twigs Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Twigs',
            'description' => 'No description provided yet...',
            'author'      => 'JD',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'JD\Twigs\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'jd.twigs.some_permission' => [
                'tab' => 'Twigs',
                'label' => 'Some permission'
            ],
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'columnise' => function($text, $classes = []) {
                    $splitContent = preg_split('/<!-- pagebreak -->/', $text);

                    if(count($splitContent) <= 1) {
                        return $text;
                    }
                    
                    $columnisedText = array_map(function($textBlock, $key) use ($classes) {
                        $output = '<div';
                        $output .= (count($classes) > 0) ? ' class="' . join(' ', $classes) . '">' : '>';
                        $output .= ($key > 0) ? '<p>' : '';
                        $output .= $textBlock;
                        $output .= ($key === 0) ? '</p>' : '';
                        $output .= '</div>';
                        
                        return $output;
                    }, $splitContent, array_keys($splitContent));

                    return '<div class="row">' . join('', $columnisedText) . '</div>';
                }
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'twigs' => [
                'label'       => 'Twigs',
                'url'         => Backend::url('jd/twigs/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['jd.twigs.*'],
                'order'       => 500,
            ],
        ];
    }
}
