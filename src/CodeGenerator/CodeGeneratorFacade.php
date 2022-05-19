<?php

declare(strict_types=1);

namespace Gacela\CodeGenerator;

use Gacela\CodeGenerator\Domain\CommandArguments\CommandArguments;
use Gacela\CodeGenerator\Infrastructure\Command\MakeModuleCommand;
use Gacela\Framework\AbstractFacade;

/**
 * @method CodeGeneratorFactory getFactory()
 */
final class CodeGeneratorFacade extends AbstractFacade
{
    /**
     * @deprecated
     * TODO: Refactor MakeModuleCommand to make it instantiable without dependencies
     */
    public function getMakerModuleCommand(): MakeModuleCommand
    {
        return $this->getFactory()->createMakerModuleCommand();
    }

    public function sanitizeFilename(string $filename): string
    {
        return $this->getFactory()
            ->createFilenameSanitizer()
            ->sanitize($filename);
    }

    public function parseArguments(string $desiredNamespace): CommandArguments
    {
        return $this->getFactory()
            ->createCommandArgumentsParser()
            ->parse($desiredNamespace);
    }

    public function generateFileContent(
        CommandArguments $commandArguments,
        string $filename,
        bool $withShortName = false
    ): string {
        return $this->getFactory()
            ->createFileContentGenerator()
            ->generate($commandArguments, $filename, $withShortName);
    }
}
