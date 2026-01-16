<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Thoth LMS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { background: #f8f9fa; padding: 20px; margin-bottom: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .section { margin-bottom: 30px; }
        .course-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .course-card { border: 1px solid #ddd; padding: 15px; border-radius: 5px; }
        .course-card h3 { margin-top: 0; }
        .btn { display: inline-block; padding: 8px 16px; background: #007bff; 
               color: white; text-decoration: none; border-radius: 3px; }
        .btn:hover { background: #0056b3; }
        .logout { float: right; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <a href="/logout" class="btn logout">Déconnexion</a>
        </div>
        
        <div class="section">
            <h2>Mes cours</h2>
            <?php if (empty($courses)): ?>
                <p>Vous n'êtes inscrit à aucun cours.</p>
            <?php else: ?>
                <div class="course-list">
                    <?php foreach ($courses as $course): ?>
                        <div class="course-card">
                            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p><?php echo htmlspecialchars($course['description']); ?></p>
                            <a href="/student/course/<?php echo $course['id']; ?>" class="btn">Voir les détails</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="section">
            <h2>Tous les cours disponibles</h2>
            <?php if (empty($allCourses)): ?>
                <p>Aucun cours disponible.</p>
            <?php else: ?>
                <div class="course-list">
                    <?php foreach ($allCourses as $course): ?>
                        <?php 
                        // Vérifier si l'étudiant est déjà inscrit à ce cours
                        $isEnrolled = false;
                        foreach ($courses as $enrolledCourse) {
                            if ($enrolledCourse['id'] == $course['id']) {
                                $isEnrolled = true;
                                break;
                            }
                        }
                        ?>
                        <?php if (!$isEnrolled): ?>
                            <div class="course-card">
                                <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                                <p><?php echo htmlspecialchars($course['description']); ?></p>
                                <a href="/student/course/<?php echo $course['id']; ?>" class="btn">Voir les détails</a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php if (empty(array_filter($allCourses, function($course) use ($courses) {
                    foreach ($courses as $enrolledCourse) {
                        if ($enrolledCourse['id'] == $course['id']) {
                            return false;
                        }
                    }
                    return true;
                }))): ?>
                    <p>Tous les cours disponibles sont déjà dans vos cours.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
