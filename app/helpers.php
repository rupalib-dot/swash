<?php
use App\Models\Locations;

function getLocationName($id){
    $row = Locations::where('id', $id)->first();
    return $row->name;
}
?>
