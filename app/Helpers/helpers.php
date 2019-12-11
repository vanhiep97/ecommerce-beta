<?php
namespace app\Helpers;
use App\Models\Category;
use CustomHelpers;

class helpers
{
    public static function menu($data,$parent = 0,$str = "", $select = 0){
        foreach ($data as $key => $value) {
            $id = $value->id;
            $name = $value->cat_name;
            if($value->cat_parent_id == $parent){
                if($select != 0 && $id == $select){
                    echo '<option class="bo_cha" value="'.$id.'" selected="selected">'.$str.$name.'</option>';
                }else{
                    echo '<option class="bo_cha" value="'.$id.'">'.$str. $name .'</option>';
                }
                CustomHelpers::menu($data,$id, $str."--", $select);
            }
        }
    }

    public static function showCategories($data, $parent_id = 0, $str = '', $select = 0, $classLI='has', $classUL = 'tree')
    {
        $cate_child = array();
        foreach ($data as $key => $value)
        {
            if ($value['cat_parent_id'] == $parent_id)
            {
                $cate_child[] = $value;
                unset($data[$key]);
            }
        }
        if ($cate_child)
        {
            echo '<ul class="'.$classUL.'">';
            foreach ($cate_child as $key => $value)
            {
                if($select != 0 && $value['id'] == $select){
                    echo '<li class="'.$classLI.'"><input type="checkbox" name="category_id[]" id="category_id" value="'.$value['id'].'" checked/><label>'.$value['cat_name'].'</label>';
                }else{
                    echo '<li class="'.$classLI.'"><input type="checkbox" name="category_id[]" id="category_id" value="'.$value['id'].'"/><label>'.$value['cat_name'].'</label>';
                }
                CustomHelpers::showCategories($data, $value['id'], $str.'|---', $select, '', '');
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    public static function showParentMenu($valueWhere)
    {
        $parent_name = Category::where('id', '=', $valueWhere)->select('cat_name')->first();
        return $parent_name['cat_name'];
    }
}
