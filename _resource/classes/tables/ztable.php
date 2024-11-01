<?php
if (!defined('ABSPATH')) die('Access Denied');

class zemesztable {

    public $cols;
    public $table;
    private $new;

    protected function __construct( $table, $columns){
        $this->table = $table;
        $this->cols = $columns;
        $this->new = false;
    }

    public function bind($data){
        if(! is_array($data)){
            return false;
        }
        if(!isset($data['id'])){
            return false;
        }
        if( ! is_numeric($data['id'])){
            $this->new = true;
        }

        $arr = array();
        
        if($this->new){
            foreach ($this->cols as $key => $value){
                if(array_key_exists($key, $data)){
                    $arr[$key] = $data[$key];
                }else{
                    if($value !== ''){
                        $arr[$key] = $value;
                    }
                }
            }
        }else{
            foreach ($this->cols as $key => $value){
                if(array_key_exists($key, $data)){
                    $arr[$key] = $data[$key];
                }
            }
        }
        
        $this->cols = $arr;
        return true;
    }

    public function check(){
        return true;
    }

    public function store(){
        if($this->new){
            $result = zemesdb::insert($this->cols, $this->table);
            if($result){
                $this->cols['id'] = $result;
                return true;                
            }else{
                return false;
            }
        }else{
            $result = zemesdb::update($this->cols, $this->table);
            return $result;
        }

    }

    public function update($data){
        if((!is_array($data)) || (empty($data)))
            return false;
        $result = zemesdb::update($data, $this->table);
        return $result;
    }

    public function delete($id){
        if(!is_numeric($id)) return false;
        $result = zemesdb::delete(array('id' => $id), $this->table);
        return $result;
    }
}
?>