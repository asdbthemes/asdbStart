<?php

class global_blocks {
    private static $global_instances = array();

    static function add_instance($block_name, $block_instance) {
        self::$global_instances[$block_instance->block_id] = array (
            'id' => $block_instance->block_id,
            'name' => $block_name,
            'instance' => $block_instance
        );
    }

    static function get_instance($block_id) {
        return self::$global_instances[$block_id]['instance'];
    }
}
