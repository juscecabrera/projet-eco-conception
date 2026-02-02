<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Non autorisé']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

$partie_id = $input['partie_id'] ?? null;
$score     = $input['score'] ?? null;
$statut    = $input['statut'] ?? 'defaite';
$user_id   = $_SESSION['id'];

if (!$partie_id || !is_numeric($score) || $score < 0) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

$statuts_valides = ['victoire', 'defaite', 'abandon'];
if (!in_array($statut, $statuts_valides)) {
    echo json_encode(['success' => false, 'message' => 'Statut invalide']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        UPDATE partie
        SET date_fin = NOW(),
            score = :score,
            statut = :statut
        WHERE id_partie = :id_partie
          AND id_utilisateur = :user_id
          AND date_fin IS NULL
    ");

    $stmt->execute([
        ':score' => $score,
        ':statut' => $statut,
        ':id_partie' => $partie_id,
        ':user_id' => $user_id
    ]);

    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Partie introuvable ou déjà terminée']);
        exit;
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur']);
}
