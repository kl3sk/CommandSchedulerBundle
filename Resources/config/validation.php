<?php

declare(strict_types=1);

use JMose\CommandSchedulerBundle\Entity\ScheduledCommand;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('namespaces', ['CommandSchedulerConstraints' => 'JMose\CommandSchedulerBundle\Validator\Constraints\\']);

    $containerConfigurator->extension(
        ScheduledCommand::class,
        ['properties' => [
            'cronExpression' => [
                ['NotBlank' => null],
                ['CommandSchedulerConstraints:CronExpression' => ['message' => 'commandScheduler.validation.cron']],
            ],
            'name' => [['NotBlank' => null]],
            'command' => [['NotBlank' => null]],
            'priority' => [['Type' => ['type' => 'integer']]],
        ],
        ]
    );
};
