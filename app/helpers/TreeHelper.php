<?php

namespace Chayka\WIXTest;

use Chayka\Helpers\Util;

class TreeHelper{

    /**
     * @return array
     */
    public static function loadTreeIterative(){
        $nodes = TreeNodeModel::selectAll();
        $rootNodes = [];
        $index = [];
        foreach($nodes as $node){
            $index[$node->getId()] = $node;
            $parentId = $node->getParentId();
            if($node->getParentId()){
                $parent = $index[$parentId];
                $parent->addChild($node);
            }else{
                $rootNodes[]= $node;
            }
        }

        return $rootNodes;
    }

    /**
     * @param int $root
     * @return array|\Chayka\WP\Helpers\DbReady|null
     */
    public static function loadTreeRecursive($root = 0){
        $nodes = TreeNodeModel::selectBy('parent_id', $root, true);
        foreach($nodes as $node){
            $node->setChildren(self::loadTreeRecursive($node->getId()));
        }

        return $nodes;
    }

    /**
     * @param TreeNodeModel $root
     * @internal param int $nodeId
     */
    public static function deleteNodeRecursive($root){
        $nodes = $root->loadChildren();
        foreach($nodes as $node){
            self::deleteNodeRecursive($node);
        }

        $root->delete();
    }

}