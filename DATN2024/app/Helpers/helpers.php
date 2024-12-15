<?php
if (! function_exists('check_show_variants_ui')) {
    function check_show_variants_ui($key)
    {
        $product_variants = session('product_variants');

        if (!$product_variants) {
            return null;
        }

        return array_key_exists($key, $product_variants);
    }
}
