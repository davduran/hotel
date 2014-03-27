<?php


namespace ByHours\HotelBundle\Util;

class Util
{
    public static function getSlug($cadena, $separador = '-')
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace('/[^a-zA-Z0-9\/_|+ -]/', '', $slug);
        $slug = strtolower(trim($slug, $separador));
        $slug = preg_replace('/[\/_|+ -]+/', $separador, $slug);

        return $slug;
    }
}
