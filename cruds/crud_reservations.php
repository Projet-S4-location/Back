<?php
function create_reservation($conn, $id_user, $id_product, $start_date, $end_date){

     /* fonction pour ajouter / créer un nouveau 'reservation'
      *              entrée: élément de connexion
      *                      toutes les variables: valeurs des colonnes
      *                      $file: le fichier lui-même (pas le chemin)
      *              sortie: résultat de l'insertion ou false en cas d'échec
     */
 
     // Vérifiez si un fichier a été téléchargé
    $sql = "INSERT INTO `reservations`(`id_user`, `id_product`, `start_date`, `end_date`) VALUES ($id_user, $id_product, '$start_date', '$end_date') ";
    $result = mysqli_query($conn, $sql);
    // Vérifiez si l'insertion a réussi
    return $result;

}
    
        
function update_reservation($conn, $id_user, $id_product, $start_date, $end_date, $id){

/* fonction pour update / modifier un(e) 'reservation' en fonction de l'id
 *              entree: element de connexion
 *                      toutes les variables: valeurs des colonnes
 *              sortie: sql request
 */

 
    $sql = "UPDATE `reservations` SET `id_user`= '$id_user',`id_product`='$id_product',`start_date`= '$start_date',`end_date`= '$end_date' WHERE `id_subscription` = $id";
    return mysqli_query($conn, $sql);
}

    
function update_reservation_with_parameter($conn, $parameter_name, $parameter_value, $id){

/* fonction pour update / modifier un(e) 'reservation' en fonction d'un parametre
 *              entree: element de connexion
 *                      $parameter_name: nom du parametre a modifier
                        $parameter_value: valeur du parametre a modifier
 *              sortie: sql request
 */

$sql = "UPDATE `reservations` set `$parameter_name`='$parameter_value' WHERE `id_subscription`=$id";
return mysqli_query($conn, $sql);
}
    


function select_reservation($conn, $id){

/* fonction pour selectionner un(e) 'reservation' en fonction de l'id
     *              entree: element de connexion
     *                      id: id de 'reservation' a recuperer
     *              sortie: element
*/

$sql = "SELECT * FROM `reservations` WHERE `id_subscription`=$id";
if($ret=mysqli_query($conn, $sql)){
    $ret=mysqli_fetch_assoc($ret);
}
return $ret;
}
function select_reservations_product($conn, $id_product){

    /* fonction pour selectionner un(e) 'reservation' en fonction de l'id
         *              entree: element de connexion
         *                      id: id de 'reservation' a recuperer
         *              sortie: element
    */
    
    $sql = "SELECT `start_date`, `end_date` FROM `reservations` WHERE `id_product`=$id_product";
    $res = mysqli_query($conn, $sql);
    $reservations = [];
     while ($row = mysqli_fetch_assoc($res)) {
		$reservations[] = $row;
	}
    return $reservations;
}
function select_all_reservations($conn){
     $sql = "SELECT * FROM `reservations` ORDER BY `id_subscription`";
     $res = mysqli_query($conn, $sql);
     $reservations = [];
     while ($row = mysqli_fetch_assoc($res)) {
		$reservations[] = $row;
	}
     return $reservations;
}


function delete_reservation($conn, $id){

/* fonction pour supprimer un(e) 'reservation' en fonction de l'id
     *              entree: element de connexion
     *                      id: id de 'reservation' a supprimer
     *              sortie: sql request
*/

$sql = "DELETE FROM `reservations` WHERE `id_subscription`=$id";
return mysqli_query($conn, $sql);
}
