<?php 

$finder = PhpCsFixer\Finder::create()
->exclude(['vendor', '.idea'])
->in(__DIR__);

return (new PhpCsFixer\Config())->setFinder($finder)
->setRiskyAllowed(true)
->setRules([
    '@PER' => true,
    'array_push' => true,
    'array_syntax' => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_alias_language_construct_call' => true,
    'whitespace_after_comma_in_array' => ['ensure_single_space' => true],
    'trim_array_spaces' => true,
    'method_argument_space' => ['on_multiline' => 'ignore']
]);