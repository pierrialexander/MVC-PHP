<?php

namespace App\Utils;

/**
 * Classe responsável por auxiliar nas renderizações dinâmicas nas Views.
 */
class View
{
    /**
     * Método responsável por retornar o conteúdo de uma view
     * @param string $view
     * @return string void
     */
    private static function getContentView($view)
    {
        $file = __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por retornar o conteúdo renderizado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        // CONTEÚDO DA VIEW
        $contentView = self::getContentView($view);

        // CHAVE DO ARRAY DE VARIAVEIS
        $keys = array_keys($vars);

        // Agora montamos um novo array com as chaves, para depois fazer o replace.
        $keys = array_map(function($item) {
            return '{{' . $item . '}}';
        }, $keys);

        // Retornamos o replace.
        return str_replace($keys, array_values($vars), $contentView);
    }
}