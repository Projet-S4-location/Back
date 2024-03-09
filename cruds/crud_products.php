<?php
function create_product($conn, $name, $type, $desc, $price, $file){

     /* fonction pour ajouter / créer un nouveau 'product'
      *              entrée: élément de connexion
      *                      toutes les variables: valeurs des colonnes
      *                      $file: le fichier lui-même (pas le chemin)
      *              sortie: résultat de l'insertion ou false en cas d'échec
     */
 
     // Vérifiez si un fichier a été téléchargé
     if (isset($file)) {
         // Récupérez le nom temporaire du fichier
         $file_tmp = $file["fichier"]['tmp_name'];
 
         // Lisez le contenu du fichier
         $file_content = file_get_contents($file_tmp);
 
         // Echappez le contenu pour l'insérer dans la base de données (pour éviter les injections SQL)
         $file_content_escaped = mysqli_real_escape_string($conn, $file_content);
 
         // Insérez le contenu du fichier dans la base de données
         $sql = "INSERT INTO `products`(`name`, `type`, `desc`, `price`, `image`) VALUES('$name', '$type', '$desc', '$price', '$file_content_escaped') ";
         $result = mysqli_query($conn, $sql);
 
         // Vérifiez si l'insertion a réussi
         return $result;
     } else {
         // Gérez les erreurs de téléchargement de fichier
         $sql = "INSERT INTO `products`(`name`, `type`, `desc`, `price`) VALUES('$name', '$type', '$desc', '$price') ";
         $result = mysqli_query($conn, $sql);
         return $result;
     }
 }
 
    
        
        
function update_product($conn, $name, $type, $desc, $price, $file, $id){

/* fonction pour update / modifier un(e) 'product' en fonction de l'id
 *              entree: element de connexion
 *                      toutes les variables: valeurs des colonnes
 *              sortie: sql request
 */

 if (isset($file)) {
     // Récupérez le nom temporaire du fichier
     $file_tmp = $file["fichier"]['tmp_name'];

     // Lisez le contenu du fichier
     $file_content = file_get_contents($file_tmp);

     // Echappez le contenu pour l'insérer dans la base de données (pour éviter les injections SQL)
     $file_content_escaped = mysqli_real_escape_string($conn, $file_content);
     $sql = "UPDATE `products` set `name`='$name', `type`='$type', `desc`='$desc', `price`='$price', `image`='$file_content_escaped' WHERE`id_product`=$id";
     return mysqli_query($conn, $sql);
}
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
     $sql = "SELECT `id_product`, `name`, `type`, `desc`, `price` FROM `products` ORDER BY `id_product`";
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
     $sql = "SELECT `id_product`, `name`, `type`, `desc`, `price` FROM `products` WHERE type != 'studio' ORDER BY `id_product`";
     $products = array();
     if ($res = mysqli_query($conn, $sql))
     {
          while($row=mysqli_fetch_assoc($res)){
		     $products[]=$row;	
	     }
     }
     return $products;
}


function select_image($conn, $id){
     /* fonction pour selectionner un(e) 'product' en fonction de l'id
          *              entree: element de connexion
          *                      id: id de 'product' a recuperer
          *              sortie: element
     */
     
     $sql = "SELECT `image` FROM `products` WHERE `id_product`=$id";
     if($ret=mysqli_query($conn, $sql)){
         $ret=mysqli_fetch_assoc($ret);
     }
     return $ret;
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