<?php

declare(strict_types=1);

namespace cbenco\TimestampGenerator;

final class Web
{
    public function index()
    {
        $result = '';
        if (isset($_POST['generator-start'], $_POST['generator-end'], $_POST['limit'])) {
            if ($_POST['limit'] > 10000) {
                throw new \Exception('The limit cant be above 10000');
            }
            $result = 'Following Timestamps have been generated: <br />';
            $result .= implode('<br />', (new TimeStampGenerator(
                \DateTimeImmutable::createFromMutable((new \DateTime($_POST['generator-start']))),
                \DateTimeImmutable::createFromMutable((new \DateTime($_POST['generator-end']))),
            ))->generateRange((int)$_POST['limit']));
            $result .= '<br />';
        }

        return <<<HTML

<title>Generate TimeStamps for a DateRange</title>

<h1 style="text-align: center">Generate TimeStamps for a DateRange</h1>

<div>

<form action="index.php" method="post">

<label for="start">Start date:</label>
<input type="date" id="start" name="generator-start"
       value="2020-07-22">
       
<label for="end">End date:</label>
<input type="date" id="end" name="generator-end"
       value="2020-07-31">

<label for="limit">How many should be generated:</label>
<input type="number" id="limit" name="limit"
       min="1" max="10000">
</form>

<br />
<br />
<br />
${result}
</div>

HTML;
    }
}
