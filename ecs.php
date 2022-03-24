<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAnnotationWithoutDotFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SetList::ARRAY);
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::COMMENTS);
    $containerConfigurator->import(SetList::COMMON);
    $containerConfigurator->import(SetList::CONTROL_STRUCTURES);
    $containerConfigurator->import(SetList::DOCBLOCK);
    $containerConfigurator->import(SetList::DOCTRINE_ANNOTATIONS);
    $containerConfigurator->import(SetList::NAMESPACES);
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::SPACES);
    $containerConfigurator->import(SetList::STRICT);

    $services = $containerConfigurator->services();
    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $services->set(OrderedImportsFixer::class)
        ->call('configure', [[
            'imports_order' => [
                'class',
                'const',
                'function'
            ]
        ]]);

    $services->set(DeclareEqualNormalizeFixer::class)
        ->call('configure', [[
            'space' => 'none'
        ]]);

    $services->set(BracesFixer::class)
        ->call('configure', [[
            'allow_single_line_closure' => false,
            'position_after_functions_and_oop_constructs' => 'next',
            'position_after_control_structures' => 'same',
            'position_after_anonymous_constructs' => 'same',
        ]]);

    $services->set(VisibilityRequiredFixer::class)
        ->call('configure', [[
            'elements' => [
                'const',
                'method',
                'property',
            ]
        ]]);


    $services->set(BlankLineBeforeStatementFixer::class)
        ->call('configure', [[
            'statements' => ['return']
        ]]);

    $parameters->set(Option::SKIP, [
        AssignmentInConditionSniff::class,
        ClassAttributesSeparationFixer::class,
        OrderedClassElementsFixer::class,
        ConcatSpaceFixer::class,
        IncrementStyleFixer::class,
        UnaryOperatorSpacesFixer::class,
        PhpdocAnnotationWithoutDotFixer::class,
        PhpdocSummaryFixer::class,
        NoSuperfluousPhpdocTagsFixer::class,
        PhpUnitStrictFixer::class,
        DeclareStrictTypesFixer::class,
        __DIR__ . '/tests/Dredd/Names.php' // Auto Generated Code
    ]);
};
