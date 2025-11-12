#!/usr/bin/env php
<?php
// Project-specific Production Readiness Suite wrapper
// This script runs from within the project directory

$projectPath = __DIR__;
$suitePath = dirname(dirname(__FILE__)) . '/ProductionReadinessSuite';

require_once $suitePath . '/autoload.php';

use ProductionReadinessSuite\ProjectWorkflowManager;

$manager = new ProjectWorkflowManager($projectPath);

// Parse arguments
$command = $argv[1] ?? 'status';

switch ($command) {
    case 'init':
        $result = $manager->initialize();
        break;
    case 'analyze':
    case 'analysis':
        $result = $manager->analyze();
        break;
    case 'test':
    case 'tests':
        $result = $manager->test();
        break;
    case 'fix':
    case 'fixes':
        $result = $manager->fix();
        break;
    case 'validate':
    case 'validation':
        $result = $manager->validate();
        break;
    case 'status':
        $result = $manager->status();
        break;
    case 'continue':
    case 'next':
        $result = $manager->continue();
        break;
    default:
        echo "Usage: php production-ready.php [command]\n\n";
        echo "Commands:\n";
        echo "  init       - Initialize production readiness suite in this project\n";
        echo "  analyze    - Analyze project structure and dependencies\n";
        echo "  test       - Generate and run tests\n";
        echo "  fix        - Fix auto-fixable issues\n";
        echo "  validate   - Validate production readiness\n";
        echo "  status     - Show current status\n";
        echo "  continue   - Continue to next logical step\n";
        exit(1);
}

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";