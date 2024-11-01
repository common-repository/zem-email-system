<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemeshtml {
    static function textarea($nameid, $val, $attr=array()) {
        $tag = '<textarea name="'.$nameid.'" id="'.$nameid.'" ';
        if (!empty($attr))
            foreach ($attr AS $key => $val)
                $tag .= ' '.$key.'="'.$val.'"';
        $tag .= ' >'.$val.'</textarea>';
        return $tag;
    }
    static function button($nameid, $val, $attr=array()) {
        $tag = '<input type="button" name="'.$nameid.'" id="'.$nameid.'" value="'.$val.'"';
        if (!empty($attr))
            foreach ($attr AS $key => $val)
                $tag .=' '.$key.'="'.$val.'"';
        $tag .= ' />';
        return $tag;
    }
    static function hidden($nameid, $val, $attr=array()) {
        $tag = '<input type="hidden" name="'.$nameid.'" id="'.$nameid.'" value="'.$val.'"';
        if (!empty($attr))
            foreach ($attr AS $key => $val)
                $tag .=' '.$key.'="'.$val.'"';
        $tag .= ' />';
        return $tag;
    }
    static function text($nameid, $val, $attr=array()) {
        $tag = '<input type="text" name="'.$nameid.'" id="'.$nameid.'" value="'.$val.'"';
        if (!empty($attr))
            foreach ($attr AS $key => $val)
                $tag .=' '.$key.'="'.$val.'"';
        $tag .= ' />';
        return $tag;
    }
    static function submit($nameid, $val, $attr=array()) {
        $tag = '<input type="submit" name="'.$nameid.'" id="'.$nameid.'" value="'.$val.'"';
        if (!empty($attr))
            foreach ($attr AS $key => $val)
                $tag .=' '.$key.'="'.$val.'"';
        $tag .= ' />';
        return $tag;
    }
    static function password($nameid, $val, $attr=array()) {
        $tag = '<input type="password" name="'.$nameid.'" id="'.$nameid.'" value="'.$val.'"';
        if (!empty($attr))
            foreach ($attr AS $key => $val)
                $tag .=' '.$key.'="'.$val.'"';
        $tag .= ' />';
        return $tag;
    }
    static function radio($nameid, $list, $d_val, $attr=array()) {
        $tag = '';
        $count = 1;
        foreach ($list AS $val => $label) {
            $tag .= '<input type="radio" name="'.$nameid.'" id="'.$nameid.$count.'" value="'.$val.'"';
            if ($d_val == $val)
                $tag .= ' checked="checked"';
            if (!empty($attr))
                foreach ($attr AS $key => $val) {
                    $tag .= ' '.$key.'="'.$val.'"';
                }
            $tag .= '/><label id="for'.$nameid.'" for="'.$nameid.$count.'">'.$label.'</label>';
            $count++;
        }
        return $tag;
    }
    static function checkbox($nameid, $list, $d_val, $attr=array()) {
        $tag = '';
        $count = 1;
        foreach ($list AS $val => $label) {
            $tag .= '<input type="checkbox" name="'.$nameid.'" id="'.$nameid.$count.'" value="'.$val.'"';
            if ($d_val == $val)
                $tag .= ' checked="checked"';
            if (!empty($attr))
                foreach ($attr AS $key => $val) {
                    $tag .= ' '.$key.'="'.$val.'"';
                }
            $tag .= '/><label id="for'.$nameid.'" for="'.$nameid.$count.'">'.$label.'</label>';
            $count++;
        }
        return $tag;
    }
    static function select($nameid, $list, $d_val, $title = '', $attr=array()) {
        $tag = '<select name="'.$nameid.'" id="'.$nameid.'" ';
        if (!empty($attr))
            foreach ($attr AS $key => $val) {
                $tag .= ' '.$key.'="'.$val.'"';
            }
        $tag .= ' >';
        if ($title != '') {
            $tag .= '<option value="">'.$title.'</option>';
        }
        if (!empty($list))
            foreach ($list AS $item) {
                if ($d_val == $item->id)
                    $tag .= '<option selected="selected" value="'.$item->id.'">'.$item->text.'</option>';
                else
                    $tag .= '<option value="'.$item->id.'">'.$item->text.'</option>';
            }
        $tag .= '</select>';
        return $tag;
    }
}
?>