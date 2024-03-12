<?php

function select_all_tag($conn){
    $sql = "SELECT name FROM `tag` ORDER BY name";
    if ($res = mysqli_query($conn, $sql))
    {
         $res = mysqli_fetch_all($res);
    }
    return $res;
}

function get_tags_by_product($conn, $id){

    $sql = "SELECT `id_tag` FROM `products_tags` WHERE id_product = $id";
    $res = mysqli_query($conn, $sql);

    $tags = array();
    if ($res) {
        $tagIds = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $tagIds[] = $row['id_tag'];
        }


        
        $tagIdsString = implode(",", $tagIds);
        $sql = "SELECT `name` FROM `tag` WHERE id_tag IN ($tagIdsString)";
        $res_tags = mysqli_query($conn, $sql);

        
        if ($res_tags) {
            while ($row_tag = mysqli_fetch_assoc($res_tags)) {
                $tags[] = $row_tag['name'];
            }
        }
    }


    return $tags;
}


