<?php
require_once(sprintf("%s/twitteroauth/twitteroauth.php", dirname(__FILE__)));

/*para un plugin mas trabajado estos datos se podrian incluir
los datos de claves de twitter usando un menu en el dashboard de twitter
que tenga los campos de entrada para los datos de autentificacion.
Mientras tanto se usan estaticamente.
*/
 $twitterConnection = new TwitterOAuth(
					's4Hf5188WAWyTSsPn8sTldSWN',	// Consumer Key
					'KKTZzZ1qd0pqlYKEjPhfq3qvEiIYosh4217JRIA50Tb1WhHcSv',   	// Consumer secret
					'161200970-9eSo4UfLwaotFajZxYM5oUNWp47YiI9enAm62X0O',       // Access token
					'N1kOe6yvjUZLnlS3YWnRDRnK8GcGjnHpIgL9y9OBZgWir'    	// Access token secret
					);
$query = array(
  "q" => $_GET["hashtag"],
  "count"=> 20,
);
$response= $twitterConnection->get("search/tweets", $query);



echo json_encode($response);

?>
