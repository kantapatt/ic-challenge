<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add_points') {
        $userId = $_POST['user_id'];
        $points = $_POST['points'];
        $activityType = $_POST['activity_type'];

        $stmt = $conn->prepare("INSERT INTO points (user_id, points, activity_type) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $points, $activityType);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        $stmt->close();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['action'] === 'get_leaderboards') {
        $individualLeaderboard = getIndividualLeaderboard();
        $teamLeaderboard = getTeamLeaderboard();

        echo json_encode([
            'individual' => $individualLeaderboard,
            'team' => $teamLeaderboard
        ]);
    }
}

function getIn
function getIndividualLeaderboard() {
    global $conn;
    $sql = "SELECT users.name, SUM(points.points) as total_points 
            FROM users 
            JOIN points ON users.id = points.user_id 
            GROUP BY users.id 
            ORDER BY total_points DESC 
            LIMIT 10";
    $result = $conn->query($sql);
    $leaderboard = [];
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = [
            'name' => $row['name'],
            'points' => $row['total_points']
        ];
    }
    return $leaderboard;
}

function getTeamLeaderboard() {
    global $conn;
    $sql = "SELECT teams.name, SUM(points.points) as total_points 
            FROM teams 
            JOIN users ON teams.id = users.team_id 
            JOIN points ON users.id = points.user_id 
            GROUP BY teams.id 
            ORDER BY total_points DESC 
            LIMIT 5";
    $result = $conn->query($sql);
    $leaderboard = [];
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = [
            'name' => $row['name'],
            'points' => $row['total_points']
        ];
    }
    return $leaderboard;
}