<?php

namespace Chayka\WIXTest;

require_once 'app/models/TreeNodeModel.php';
require_once 'app/helpers/TreeHelper.php';

use Chayka\Helpers\HttpHeaderHelper;
use Chayka\WP\MVC\Controller;
use Chayka\Helpers\InputHelper;
use Chayka\WIXTest\TreeNodeModel;

class TreeController extends Controller{

    public function init(){
        // NlsHelper::load('main');
        // InputHelper::captureInput();
        wp_enqueue_style('wix-tree');
    }

    public function indexAction(){
        echo "Hello Tree!";
    }

    public function recursiveAction(){
        $this->view->assign('nodes', TreeHelper::loadTreeRecursive());
    }

    public function iterativeAction(){
        $this->view->assign('nodes', TreeHelper::loadTreeIterative());
    }

    public function editorAction(){
        $this->view->assign('nodes', TreeNodeModel::selectAll());
    }

    public function addAction(){
        $parentId = InputHelper::getParam('parent_id', 0);
        $title = InputHelper::getParam('title');

        if($title){
            $node = new TreeNodeModel();
            $node->setParentId($parentId);
            $node->setTitle($title);
            $node->insert();
        }

        HttpHeaderHelper::redirect('/tree/editor');
    }

    public function removeAction(){
        $nodeId = InputHelper::getParam('node_id', 0);
        if($nodeId){
            $node = TreeNodeModel::selectById($nodeId);
            TreeHelper::deleteNodeRecursive($node);
        }

        HttpHeaderHelper::redirect('/tree/editor');
    }

}