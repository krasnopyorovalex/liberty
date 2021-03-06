<?php

use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Riverskies\Laravel\MobileDetect\Facades\MobileDetect;

if (! function_exists('str_template')) {
    /**
     *
     * @param string $string
     * @param array $params
     * @return array|string|string[]
     */
    function str_template(string $string, array $params = [])
    {
        $search = array_map(function ($v) {
            return '{' . $v . '}';
        }, array_keys($params));
        return str_replace($search, array_values($params), $string);
    }
}

if (! function_exists('build_root_child_select')) {
    /**
     * @param $collection
     * @param null $selected
     * @return string
     */
    function build_root_child_select($collection, $selected = null): string
    {
        $returnedArray = [];

        foreach ($collection as $item) {
            if (!$item['parent_id']) {
                $returnedArray[] = $item;
                continue;
            }
            $returnedArray['child_' . $item['parent_id']][] = $item;
        }

        return build_options($returnedArray, $selected);
    }
}

if (! function_exists('build_options')) {
    /**
     * @param array $array
     * @param $selected
     * @param string $html
     * @param string $step
     * @param array $helpArray
     * @return string
     */
    function build_options(array $array, $selected, string $html = '', string $step = '', array $helpArray = []): string
    {
        $originArray = count($helpArray) ? $helpArray : $array;
        foreach ($array as $item) {
            if (!is_array($item)) {

                $html .= '<option value="' . $item->id . '"' . ($selected == $item->id ? 'selected=""' : '') . '>' . $step . $item->name . '</option>' . PHP_EOL;

                if (isset($originArray['child_' . $item->id])) {
                    $html = build_options($originArray['child_' . $item->id], $selected, $html, $step . '**', $array);
                }
            }
        }
        return $html;
    }
}


if (! function_exists('get_ids_from_array')) {
    /**
     * @param array $array
     * @return array
     */
    function get_ids_from_array(array $array): array
    {
        return array_map(function ($item) {
            return $item['id'];
        }, $array);
    }
}


if (! function_exists('is_main_page')) {
    /**
     * @return bool
     */
    function is_main_page(): bool
    {
        return request()->path() === '/';
    }
}

if (! function_exists('add_css_class')) {
    /**
     * @param $item
     * @return string
     */
    function add_css_class($item): string
    {
        $classes = [];
        if ($item->is_service) {
            array_push($classes, 'has__child');
        }
        if (trim($item->link,'/') == request()->path() || request()->path() == $item->link) {
            array_push($classes, 'active');
        }
        return count($classes) ? ' class="'. implode(' ', $classes) .'"' : '';
    }
}

if (! function_exists('check_equal_path')) {
    /**
     * @param string $alias
     * @return bool
     */
    function check_equal_path(string $alias): bool
    {
        return request()->getPathInfo() == '/' . $alias;
    }
}

if (! function_exists('svg')) {
    function svg($symbol): HtmlString
    {
        return new HtmlString(
            '<svg class="icon icon-'.$symbol.'">
                <use xlink:href="' . asset("img/sprites/sprite.svg#{$symbol}") . '"></use>
            </svg>'
        );
    }
}

if (! function_exists('change_image_desktop_mob')) {
    function change_image_desktop_mob($entity): string
    {
        return (string) (MobileDetect::isMobile() ? $entity->image_mob : $entity->image);
    }
}

if (! function_exists('is_mobile')) {
    function is_mobile(): bool
    {
        return MobileDetect::isMobile() && !MobileDetect::isTablet();
    }
}

if (! function_exists('change_images_slider')) {
    function change_images_slider(Model $slider)
    {
        return MobileDetect::isMobile() && !MobileDetect::isTablet() ? $slider->imagesForMobile : $slider->images;
    }
}

if (! function_exists('filename_replacer')) {
    function filename_replacer(string $path, string $postfix): string
    {
        $fileName = pathinfo($path, PATHINFO_FILENAME);
        $replaceName = sprintf('%s_%s', $fileName, $postfix);

        return str_replace($fileName, $replaceName, $path);
    }
}
