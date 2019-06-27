<?php
namespace App\Interfaces;

interface PontoExpressionInterface
{
    const EXPRESSION_NEUTRO = 'Neutro';
    const EXPRESSION_FELIZ = 'Feliz';
    const EXPRESSION_TRISTE = 'Triste';
    const EXPRESSION_BRAVO = 'Bravo';
    const EXPRESSION_AMENDRONTADO = 'Amendrontado';
    const EXPRESSION_NOJO = 'Nojo';
    const EXPRESSION_SURPRESO = 'Surpreso';

    const EXPRESSIONS = [
        '0' => self::EXPRESSION_NEUTRO,
        '1' => self::EXPRESSION_FELIZ,
        '2' => self::EXPRESSION_TRISTE,
        '3' => self::EXPRESSION_BRAVO,
        '4' => self::EXPRESSION_AMENDRONTADO,
        '5' => self::EXPRESSION_NOJO,
        '6' => self::EXPRESSION_SURPRESO,
    ];
}
