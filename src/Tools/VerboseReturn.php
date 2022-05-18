<?php
declare(strict_types=1);

namespace App\Tools;

class VerboseReturn
{

    public bool $isSuccess;
    public ?int $expectedCount;
    public ?int $actualCount;

    function __construct($success, $expected = null, $actual = null) {
        $this->isSuccess = $success;
        $this->expectedCount = $expected;
        $this->actualCount = $actual;
    }
}
?>
