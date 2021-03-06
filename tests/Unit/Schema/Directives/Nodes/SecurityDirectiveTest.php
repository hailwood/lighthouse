<?php

namespace Tests\Unit\Schema\Directives\Nodes;

use GraphQL\Validator\DocumentValidator;
use GraphQL\Validator\Rules\DisableIntrospection;
use GraphQL\Validator\Rules\QueryComplexity;
use GraphQL\Validator\Rules\QueryDepth;
use Tests\TestCase;

class SecurityDirectiveTest extends TestCase
{
    /**
     * @test
     */
    public function itCanSetMaxDepth()
    {
        $schema = '
        type Query @security(depth: 3) {
            me: String
        }';

        schema()->register($schema);
        $rule = DocumentValidator::getRule(QueryDepth::class);
        $this->assertEquals(3, $rule->getMaxQueryDepth());
    }

    /**
     * @test
     */
    public function itCanSetMaxComplexity()
    {
        $schema = '
        type Query @security(complexity: 3) {
            me: String
        }';

        schema()->register($schema);
        $rule = DocumentValidator::getRule(QueryComplexity::class);
        $this->assertEquals(3, $rule->getMaxQueryComplexity());
    }
}
