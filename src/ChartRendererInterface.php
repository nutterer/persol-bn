<?php

namespace PHPMaker2021\upPersonnelv2;

/**
 * Chart renderer interface
 */
interface ChartRendererInterface
{

    public function getContainer($width, $height);

    public function getScript($width, $height);
}
