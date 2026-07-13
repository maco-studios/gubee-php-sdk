<?php

declare(strict_types=1);

$input = $argv[1] ?? 'var/test/coverage.xml';
$output = $argv[2] ?? '.github/assets/coverage.svg';

if (! is_file($input)) {
    fwrite(STDERR, "Coverage file not found: {$input}\n");
    exit(1);
}

$coverage = simplexml_load_file($input);
if (false === $coverage) {
    fwrite(STDERR, "Invalid coverage file: {$input}\n");
    exit(1);
}

$metrics = $coverage->project->metrics ?? null;
$statements = (int) ($metrics['statements'] ?? 0);
$coveredStatements = (int) ($metrics['coveredstatements'] ?? 0);

if (0 === $statements) {
    fwrite(STDERR, "Coverage file has no statement metrics: {$input}\n");
    exit(1);
}

$percent = round(($coveredStatements / $statements) * 100, 1);
$value = (string) $percent . '%';
$color = $percent >= 90 ? '4c1' : ($percent >= 80 ? '97ca00' : ($percent >= 70 ? 'dfb317' : 'e05d44'));

$label = 'coverage';
$labelWidth = 69;
$valueWidth = max(44, strlen($value) * 7 + 12);
$width = $labelWidth + $valueWidth;
$valueX = $labelWidth + ($valueWidth / 2);

$svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="20" role="img" aria-label="{$label}: {$value}">
  <title>{$label}: {$value}</title>
  <linearGradient id="s" x2="0" y2="100%">
    <stop offset="0" stop-color="#bbb" stop-opacity=".1"/>
    <stop offset="1" stop-opacity=".1"/>
  </linearGradient>
  <clipPath id="r">
    <rect width="{$width}" height="20" rx="3" fill="#fff"/>
  </clipPath>
  <g clip-path="url(#r)">
    <rect width="{$labelWidth}" height="20" fill="#555"/>
    <rect x="{$labelWidth}" width="{$valueWidth}" height="20" fill="#{$color}"/>
    <rect width="{$width}" height="20" fill="url(#s)"/>
  </g>
  <g fill="#fff" text-anchor="middle" font-family="Verdana,Geneva,DejaVu Sans,sans-serif" font-size="11">
    <text x="34.5" y="15" fill="#010101" fill-opacity=".3">{$label}</text>
    <text x="34.5" y="14">{$label}</text>
    <text x="{$valueX}" y="15" fill="#010101" fill-opacity=".3">{$value}</text>
    <text x="{$valueX}" y="14">{$value}</text>
  </g>
</svg>
SVG;

if (! is_dir(dirname($output))) {
    mkdir(dirname($output), 0777, true);
}

file_put_contents($output, $svg . "\n");
