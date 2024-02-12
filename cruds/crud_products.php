<?php
function create_product($conn, $name, $type, $desc, $price, $image){

/* fonction pour ajouter / creer un(e) new 'product'
     *              entree: element de connexion
     *                      toutes les variables: valeurs des colonnes
     *              sortie: sql request
*/
$sql = "INSERT INTO `products`(`name`, `type`, `desc`, `price`, `image`) VALUES('$name', '$type', '$desc', '$price', '$image) ";
return mysqli_query($conn, $sql);
}
    
        
        
function update_product($conn, $name, $type, $desc, $price, $image, $id){

/* fonction pour update / modifier un(e) 'product' en fonction de l'id
 *              entree: element de connexion
 *                      toutes les variables: valeurs des colonnes
 *              sortie: sql request
 */

$sql = "UPDATE `products` set `name`='$name', `type`='$type', `desc`='$desc', `price`='$price', `image`='$image' WHERE`id_product`=$id";
return mysqli_query($conn, $sql);
}
    
function update_product_with_parameter($conn, $parameter_name, $parameter_value, $id){

/* fonction pour update / modifier un(e) 'product' en fonction d'un parametre
 *              entree: element de connexion
 *                      $parameter_name: nom du parametre a modifier
                        $parameter_value: valeur du parametre a modifier
 *              sortie: sql request
 */

$sql = "UPDATE `products` set `$parameter_name`='$parameter_value' WHERE `id_product`=$id";
return mysqli_query($conn, $sql);
}
    


function select_product($conn, $id){

/* fonction pour selectionner un(e) 'product' en fonction de l'id
     *              entree: element de connexion
     *                      id: id de 'product' a recuperer
     *              sortie: element
*/

$sql = "SELECT * FROM `products` WHERE `id_product`=$id";
if($ret=mysqli_query($conn, $sql)){
    $ret=mysqli_fetch_assoc($ret);
}
return $ret;
}

function select_all_product($conn){
     $sql = "SELECT `id_product`, `name`, `type`, `desc`, `price`, `image` FROM `products` ORDER BY `id_product`";
     if ($res = mysqli_query($conn, $sql))
     {
          $res = mysqli_fetch_all($res);
     }
     return $res;
}

function select_all_studios($conn){
     $sql = "SELECT `id_product`, `name`, `type`, `desc`, `price`, `image` FROM `products` WHERE type = 'studio' ORDER BY `id_product`";
     $studios = array();
     if ($res = mysqli_query($conn, $sql))
     {
	     while($row=mysqli_fetch_assoc($res)){
		     $studios[]=$row;	
	     }
     }
     return $studios;
}

function select_all_not_studios($conn){
     $sql = "SELECT `id_product`, `name`, `type`, `desc`, `price`, `image` FROM `products` WHERE type != 'studio' ORDER BY `id_product`";
     $products = array();
     if ($res = mysqli_query($conn, $sql))
     {
          while($row=mysqli_fetch_assoc($res)){
		     $products[]=$row;	
	     }
     }
     return $products;
}

function delete_product($conn, $id){

/* fonction pour supprimer un(e) 'product' en fonction de l'id
     *              entree: element de connexion
     *                      id: id de 'product' a supprimer
     *              sortie: sql request
*/

$sql = "DELETE FROM `products` WHERE `id_product`=$id";
return mysqli_query($conn, $sql);
}

function select_all_product_with_parameter($conn, $parameter_name, $parameter_value){

    /* fonction pour selectionner tous les 'product' dans la table en fonction d'un parametre
         *              entree: element de connexion
                                $parameter_name: nom de la colonne a utiliser pour la selection
                                $parameter_value: valeur que dans la colonne pour que la ligne soit selectionnee
         *              sortie: tableau d'elements
    */
    $parameter_value_string = strval($parameter_value);
    $sql = "SELECT * FROM `products` WHERE `$parameter_name`='$parameter_value' ";
    $ret=mysqli_fetch_all(mysqli_query($conn, $sql));
    return $ret ;
    }

?>