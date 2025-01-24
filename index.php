<?php
include 'config.php';
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเก็บคะแนนกิจกรรม</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>ระบบเก็บคะแนนกิจกรรม</h1>
    </header>
    
    <main>
        <section id="add-points">
            <h2>เพิ่มคะแนน</h2>
            <form id="points-form">
                <input type="text" id="user-id" placeholder="รหัสผู้ใช้" required>
                <input type="number" id="points" placeholder="คะแนน" required>
                <select id="activity-type" required>
                    <option value="">เลือกประเภทกิจกรรม</option>
                    <option value="quiz">ตอบคำถาม</option>
                    <option value="checkin">เช็คอิน</option>
                    <option value="group">กิจกรรมกลุ่ม</option>
                </select>
                <button type="submit">บันทึกคะแนน</button>
            </form>
        </section>

        <section id="leaderboards">
            <h2>อันดับคะแนน</h2>
            <div id="individual-leaderboard">
                <h3>10 อันดับบุคคล</h3>
                <ol id="individual-list"></ol>
            </div>
            <div id="team-leaderboard">
                <h3>5 อันดับทีม</h3>
                <ol id="team-list"></ol>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>
