<?php

error_reporting(0);
include("rpc.php");

$kpc = new Keva();

$kpc->username=$krpcuser;
$kpc->password=$krpcpass;
$kpc->host=$krpchost;
$kpc->port=$krpcport;

$rpc = new Raven();

$rpc->username=$rrpcuser;
$rpc->password=$rrpcpass;
$rpc->host=$rrpchost;
$rpc->port=$rrpcport;

$_REQ = array_merge($_GET, $_POST);





//list keva namespace





//list

$age= $kpc->keva_list_namespaces();

		


$sortarr=array();
$sortto=array();

foreach($age as $y_value=>$y)

			{

			extract($y);

			

		

			$sortarr['displayName']=$displayName;
			$sortarr['namespaceId']=$namespaceId;

			

			array_push($sortto,$sortarr);
			}


arsort($sortto);


$sortarrx=array();
$sorttox=array();

			foreach($sortto as $x_value=>$x)

			{

			extract($x);
			
			//shortcode

			$namespace=$kpc->keva_get($namespaceId,"_KEVA_NS_");

			$sortarrx['num']=$namespace['height'];
			$sortarrx['name']=$namespace['value'];
			$sortarrx['id']=$namespaceId;
		

			$title=$namespace['value'];

			$snl=strlen($namespace['height']);
			
			$snm=$namespace['height'];

				

				$getblockh=$kpc->getblockheaderbyheight($snm);
			
				$getblockh=$getblockh['block_header']['hash'];
				$getblocktx=$kpc->getblock($getblockh);

			
				$sncount=0;
		
					foreach($getblocktx['tx'] as $txa){

				
						$transaction= $kpc->getrawtransaction($txa,1);

							foreach($transaction['vout'] as $vout)
	   
							  {

								$op_return = $vout["scriptPubKey"]["asm"]; 

				
									$arrb = explode(' ', $op_return); 

									if($arrb[0] == 'OP_KEVA_NAMESPACE') 
										{

								 $cona=$arrb[0];
								 $cons=$arrb[1];
								 $conk=$arrb[2];

								  $cond=$vout["scriptPubKey"]["addresses"][0];

								 $assetn=Base58Check::encode($cons, false , 0 , false);

								 if($namespaceId==$assetn){ $shortc=$snl."".$snm."".$sncount;}



										}
								 }
				
							

						$sncount=$sncount+1;

						}


				$sortarrx['sc']=$shortc;
			
array_push($sorttox,$sortarrx);





			
			}

arsort($sorttox);

			foreach($sorttox as $z_value=>$z)

			{

			extract($z);
			
			echo "<li style=\"height:30px;display:block;\"><h4>".$num."[ ".$name." ]".$id." [".$sc."]</h4></li>";

			}

//list namespace finish
?>