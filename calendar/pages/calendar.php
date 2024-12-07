<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='calendar-header'>
        <p class='time'></p>
        <p class='date'></p>
    </div>
    <hr>
    <div class='sub-header'>
        <p class='sub-date'></p>
        <div class='arrows'>
            <i id="last" class='fa-solid fa-chevron-up'></i>
            <i id="next" class='fa-solid fa-chevron-down'></i>
        </div>
    </div>
        <table>
            <thead>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednsday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </thead>
            <tbody>
            </tbody>
        </table>

    <script src="main.js"></script>
</body>
</html>