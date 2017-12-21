<?php

namespace App\Models\Analytics\Charts;

class LineChart implements \JsonSerializable
{
    private $data = [];
    private $options = [
        'responsive' => true
    ];

    public function labels(array $labels)
    {
        $this->data['labels'] = $labels;
        return $this;
    }

    public function datasets(array $datasets)
    {
        $this->data['datasets'] = array_map(function (array $dataset) {
            return (object)$dataset;
        }, $datasets);
        return $this;
    }

    public function responsive(bool $on = true)
    {
        $this->options['responsive'] = $on;
        return $this;
    }

    public function title(string $title)
    {
        $this->options['title'] = (object)[
            'display' => true,
            'text' => $title,
        ];
        return $this;
    }

    public function tooltips(bool $on = true)
    {
        $this->options['title'] = (object)[
            'mode' => 'index',
            'intersect' => false,
        ];
        return $this;
    }

    public function hover(bool $on = true)
    {
        $this->options['hover'] = (object)[
            'mode' => 'nearest',
            'intersect' => true,
        ];
        return $this;
    }

    public function labelX(string $label)
    {
        $scale = [
            'xAxes' => [
                (object)[
                    'display' => true,
                    'scaleLabel' => (object)[
                        'display' => true,
                        'labelString' => $label
                    ],
                ],
            ],
        ];
        if (array_key_exists('scales', $this->options)) {
            $this->options['scales'] = (object)array_merge((array)$this->options['scales'], $scale);
        } else {
            $this->options['scales'] = (object)$scale;
        }
        return $this;
    }

    public function labelY(string $label)
    {
        $scale = [
            'yAxes' => [
                (object)[
                    'display' => true,
                    'scaleLabel' => (object)[
                        'display' => true,
                        'labelString' => $label
                    ],
                ],
            ],
        ];
        if (array_key_exists('scales', $this->options)) {
            $this->options['scales'] = (object)array_merge((array)$this->options['scales'], $scale);
        } else {
            $this->options['scales'] = (object)$scale;
        }
        return $this;
    }

    public function __toString()
    {
        return json_encode($this);
    }

    public function jsonSerialize()
    {
        return (object)[
            'type' => 'line',
            'data' => (object)$this->data,
            'options' => (object)$this->options,
        ];
    }
}