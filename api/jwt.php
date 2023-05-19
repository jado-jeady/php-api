<?php 
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

$signer = new Sha256();
$token = (new Builder())
    ->setIssuer('http://example.com') // Issuer (your website or application URL)
    ->setAudience('http://example.org') // Audience (intended recipient of the token)
    ->setIssuedAt(time()) // Issued at (current timestamp)
    ->setExpiration(time() + 3600) // Expiration time (1 hour from now)
    ->set('user_id', $userId) // Custom claim for user ID
    ->sign($signer, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') // Sign the token with your secret key
    ->getToken();

$tokenString = (string) $token; // Get the token string

//token verifier 

function tokenverufier($token){
    use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Key;

$tokenString = '...'; // Get the token from the request

try {
    $token = (new Parser())->parse($tokenString);
    $signer = new Sha256();

    $validationData = new ValidationData();
    $validationData->setIssuer('http://example.com'); // Validate the issuer
    $validationData->setAudience('http://example.org'); // Validate the audience

    $key = new Key('your-secret-key'); // Load the secret key used for signing

    if ($token->verify($signer, $key) && $token->validate($validationData)) {
        // Token is valid, continue processing the request
        $userId = $token->getClaim('user_id'); // Get the user ID from the token
        // ...
    } else {
        // Token is invalid, return an error response
        // ...
    }
} catch (\Exception $e) {
    // Error occurred while parsing or validating the token, return an error response
    // ...
}

}

 ?>