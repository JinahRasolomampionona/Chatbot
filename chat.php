<?php
// chat.php - Gestion des messages et des sujets sensibles
header('Content-Type: application/json; charset=utf-8');

// Votre clé API Google Gemini
$GEMINI_API_KEY =  getenv('GCP_API_KEY');;

// 1. Récupération et nettoyage du message
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = trim($input['message'] ?? '');

// Si le message est vide, on renvoie une réponse courtoise
if ($userMessage === '') {
    echo json_encode(['reply' => "Bonjour ! Comment puis-je vous aider aujourd'hui ?"]);
    exit;
}

// 2. Détection des sujets très délicats (Condition False)
function isDelicateTopic($text) {
    $cleanText = mb_strtolower($text, 'UTF-8');
    
    // Mots-clés sensibles : Médical, politique/religion extrême, sécurité/piratage, données privées, illégal
    $delicateKeywords = [
        'symptôme', 'maladie', 'médicament', 'médecin', 'traitement', 'santé',
        'politique', 'élection', 'gouvernement', 'religion',
        'mot de passe', 'carte bancaire', 'rib', 'données personnelles', 'infiltrer', 'pirater', 'hack', 'exploit',
        'drogue', 'arme', 'suicide', 'insulte'
    ];

    foreach ($delicateKeywords as $keyword) {
        if (strpos($cleanText, $keyword) !== false) {
            return true; // Sujet sensible détecté
        }
    }
    return false;
}

// Si la question est jugée délicate, on applique la condition de refus (False)
if (isDelicateTopic($userMessage)) {
    echo json_encode([
        'reply' => "Désolé, je ne peux pas répondre à ce type de question délicate. Pour toute demande spécifique ou confidentielle, nous vous invitons à contacter directement notre équipe à contact@novaweb-digital.fr."
    ]);
    exit;
}

// 3. Contexte d'entreprise (System Prompt) étendu pour TOUS les messages
$systemPrompt = "Tu es NovaBot, l'assistant virtuel dynamique de l'agence NovaWeb Digital.
Consignes de comportement :
- Réponds à absolument TOUS les messages de l'utilisateur de manière polie, naturelle et courtoise en français.
- Pour les salutations (Bonjour, Coucou, Bonsoir, Ça va ?), réponds chaleureusement et présente brièvement comment tu peux l'aider dans ses projets web.
- Pour les questions sur l'agence : Présente la création de sites WordPress sur-mesure, l'E-Commerce (WooCommerce/Shopify), le SEO, le Webdesign Figma et la Maintenance.
- Pour les questions d'ordre général : Réponds poliment et ramène subtilement la conversation vers les services de création web de l'agence NovaWeb Digital si pertinent.
- Si le prospect demande un devis : Invite-le à communiquer son Nom et son E-mail pour qu'un conseiller le recontacte.
- Ne pas inventer d'informations non vérifiées.";

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $GEMINI_API_KEY;

$data = [
    "contents" => [
        [
            "role" => "user",
            "parts" => [
                ["text" => $systemPrompt . "\n\nMessage de l'utilisateur : " . $userMessage]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.6, // Légèrement plus flexible pour bien gérer les discussions amicales
        "maxOutputTokens" => 500
    ]
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
        'timeout' => 12
    ]
];

$context  = stream_context_create($options);
$response = @file_get_contents($url, false, $context);

// Si l'API échoue ou ne répond pas
if ($response === FALSE) {
    echo json_encode([
        'reply' => "Navré, je rencontre une petite difficulté réseau. N'hésitez pas à nous envoyer un message à contact@novaweb-digital.fr !"
    ]);
    exit;
}

$responseData = json_decode($response, true);
$replyText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? "Je n'ai pas pu traiter votre message. Que souhaitez-vous savoir sur nos services web ?";

echo json_encode(['reply' => $replyText]);
?>