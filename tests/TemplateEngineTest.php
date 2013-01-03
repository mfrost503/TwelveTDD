<?php
namespace TwelveTdd;

class TemplateEngineTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->templateEngine = new TemplateEngine();
    }

    public function tearDown()
    {
        unset($this->templateEngine);
    }

    /**
     * @test
     * Given that there is a template engine
     * When a single expression is evaluated
     * Then the variable should be replaced with the value
     */
    public function ReplaceSingleVariableExpressions()
    {
        $variables = array('firstName' => 'Matt');
        $this->assertContains("Matt",$this->templateEngine->evaluate('My name is ${firstName}',$variables));
    }

    /**
     * @test
     * Given that there are multiple variables
     * When evaluate is called
     * Then all the variables should be replaced with values
     */
    public function ReplaceMultipleVariableExpressions()
    {
        $variables = array('firstName'=>'Matt','lastName'=>'Frost','location'=>'Indiana');
        $expression = 'My name is ${firstName} ${lastName} and I live in ${location}';
        $expected = "My name is Matt Frost and I live in Indiana";
        $this->assertEquals($expected,$this->templateEngine->evaluate($expression,$variables));
    }

    /**
     * @test
     * Given that there is an expression with a variable that isn't provided
     * When evaluate is called
     * Then an Exception should be thrown
     * @expectedException \TwelveTdd\MissingValueException
     */
    public function EnsureExceptionIsThrownWithMissingVariable()
    {
        $expression = 'My name is ${name}';
        $variables = array('names' => 'Matt Frost');
        $this->templateEngine->evaluate($expression,$variables);
    }

    /**
     * @test
     * Given that there is a complex expression
     * When evaluate is called
     * Then the expression should only replace characters according to the pattern
     */
    public function EnsureComplexExpressionsAreEvaluatedProperly()
    {
        $expression = '${${firstName}}';
        $variables = array('firstName'=>'Matt');
        $expected = '${Matt}';
        $this->assertEquals($expected,$this->templateEngine->evaluate($expression,$variables));
        $this->assertEquals('${${Matt}}',$this->templateEngine->evaluate('${${${firstName}}}',$variables));
    }
}