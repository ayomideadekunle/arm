<?php

// index.php
function genReference($qtd) {
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;

    $Hash = NULL;

    for ($x = 1; $x <= $qtd; $x++) {
        $Posicao = rand(0, $QuantidadeCaracteres);
        $Hash .= substr($Caracteres, $Posicao, 1);
    }

    return $Hash;
}

$result = array();

//Set other parameters as keys in the $postdata array
$postdata = array(
    'email' => 'donchiwexco@gmail.com',
    'amount' => $_POST['amount'],
    "reference" => genReference(10)
);

$url = "https://api.paystack.co/transaction/initialize";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'Authorization: Bearer sk_test_*********************************',
    'Content-Type: application/json',
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$request = curl_exec($ch);

curl_close($ch);

if ($request) {

    $result = json_decode($request, true);

    header('Location: ' . $result['data']['authorization_url']);
}

// verify.php

$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/' . $_GET['reference'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
        $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_*****************************']
);
$request = curl_exec($ch);
curl_close($ch);

if ($request) {
    $result = json_decode($request, true);
}

if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
    echo "Transaction was successful";
//Perform necessary action
} else {
    echo "Transaction was unsuccessful";
}
