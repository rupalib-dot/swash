<?php 

class CommonFunction 
{
    public static function password_generate($chars) 
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, $chars);
    }
 

     //This funciton is used to pass column name in views blade files
    public static function GetSingleField($table, $select, $field, $value)
    {
        $result = \DB::table($table)->select($select)->where([$field => $value])->first();
        if (!empty($result)) {
            return $result->$select;
        } else {
            return '';
        }
    }
   
}
?>