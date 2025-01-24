document.addEventListener('DOMContentLoaded', function() {
    const pointsForm = document.getElementById('points-form');
    const individualList = document.getElementById('individual-list');
    const teamList = document.getElementById('team-list');

    pointsForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const userId = document.getElementById('user-id').value;
        const points = document.getElementById('points').value;
        const activityType = document.getElementById('activity-type').value;

        fetch('functions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=add_points&user_id=${userId}&points=${points}&activity_type=${activityType}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('คะแนนถูกบันทึกเรียบร้อยแล้ว');
                updateLeaderboards();
            } else {
                alert('เกิดข้อผิดพลาดในการบันทึกคะแนน');
            }
        });
    });

    function updateLeaderboards() {
        fetch('functions.php?action=get_leaderboards')
        .then(response => response.json())
        .then(data => {
            individualList.innerHTML = '';
            teamList.innerHTML = '';

            data.individual.forEach(user => {
                const li = document.createElement('li');
                li.textContent = `${user.name}: ${user.points} คะแนน`;
                individualList.appendChild(li);
            });

            data.team.forEach(team => {
                const li = document.createElement('li');
                li.textContent = `${team.name}: ${team.points} คะแนน`;
                teamList.appendChild(li);
            });
        });
    }

    updateLeaderboards();
});