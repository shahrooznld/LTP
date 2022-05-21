<?php
/**
 * Don't let the machines win. You are humanity's last hope...
 **/
const DEFAULT_NODE_VALUE = -1;

// $width: the number of cells on the X axis
fscanf(STDIN, "%d", $width);
// $height: the number of cells on the Y axis
fscanf(STDIN, "%d", $height);
$arrayLines = [];
for ($i = 0; $i < $height; $i++) {
    $arrayLines[] = stream_get_line(STDIN, 31 + 1, "\n");// width characters, each either 0 or .
}

for ($yAxis = 0; $yAxis < $height; $yAxis++) {
    for ($xAxis = 0; $xAxis < $width; $xAxis++) {
        if ($arrayLines[$yAxis][$xAxis] === '.') {
            continue;
        }
        [$rightXAxis, $rightYAxis] = getClosestNeighborOnRightNode($arrayLines, $xAxis, $yAxis, $width);

        [$bottomXAxis, $bottomYAxis] = getClosestNeighborOnBottomNode($arrayLines, $xAxis, $yAxis, $height);


        echo "$xAxis $yAxis $rightXAxis $rightYAxis $bottomXAxis $bottomYAxis\n";

    }
}


function getClosestNeighborOnRightNode(array $arrayLines, int $xAxis, int $yAxis, int $width): array
{
    for ($rightNodeIndex = $xAxis + 1; $rightNodeIndex < $width; $rightNodeIndex++) {
        if (isset($arrayLines[$yAxis][$rightNodeIndex]) && $arrayLines[$yAxis][$rightNodeIndex] === '0') {
            return [$rightNodeIndex, $yAxis];
        }
    }
    return [DEFAULT_NODE_VALUE, DEFAULT_NODE_VALUE];


}

function getClosestNeighborOnBottomNode(array $arrayLines, int $xAxis, int $yAxis, int $height): array
{
    for ($bottomNodeIndex = $yAxis + 1; $bottomNodeIndex < $height; $bottomNodeIndex++) {
        if (isset($arrayLines[$bottomNodeIndex][$xAxis]) && $arrayLines[$bottomNodeIndex][$xAxis] === '0') {
            return [$xAxis, $bottomNodeIndex];
        }
    }
    return [DEFAULT_NODE_VALUE, DEFAULT_NODE_VALUE];

}
