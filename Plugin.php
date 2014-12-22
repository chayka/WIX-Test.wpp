<?php

namespace Chayka\WIXTest;

use Chayka\WP;

class Plugin extends WP\Plugin{

    public static $instance = null;

    public static function init(){
        if(!static::$instance){
            static::$instance = $app = new self(__FILE__, array(
                'tree',
                /* chayka: init/controllers */
            ));
            $app->dbUpdate(array('1.0'));
	        $app->addSupport_UriProcessing();
            /* chayka: init/addSupport */
        }
    }


    /**
     * Register your action hooks here using $this->addAction();
     */
    public function registerActions() {
    	/* chayka: registerActions */
    }

    /**
     * Register your action hooks here using $this->addFilter();
     */
    public function registerFilters() {
		/* chayka: registerFilters */
    }

    /**
     * Register scripts and styles here using $this->registerScript() and $this->registerStyle()
     *
     * @param bool $minimize
     */
    public function registerResources($minimize = false) {
        $this->registerStyle('wix-tree', 'dist/css/style.css');
		/* chayka: registerResources */
    }

    /**
     * Routes are to be added here via $this->addRoute();
     */
    public function registerRoutes() {
        $this->addRoute('default');
    }
}