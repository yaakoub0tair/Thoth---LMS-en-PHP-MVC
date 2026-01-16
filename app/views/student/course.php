<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Thoth LMS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { background: #f8f9fa; padding: 20px; margin-bottom: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .course-info { background: #e9ecef; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background: #007bff; 
               color: white; text-decoration: none; border-radius: 3px; margin-right: 10px; }
        .btn:hover { background: #0056b3; }
        .btn.success { background: #28a745; }
        .btn.success:hover { background: #1e7e34; }
        .logout { float: right; }
        .back { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="/student/dashboard" class="btn back">← Retour au tableau de bord</a>
            <h1><?php echo htmlspecialchars($course['title']); ?></h1>
            <a href="/logout" class="btn logout">Déconnexion</a>
        </div>
        
        <div class="course-info">
            <h2>Détails du cours</h2>
            <p><strong>Description:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
        </div>
        
        <div class="actions">
            <?php if ($isEnrolled): ?>
                <p style="color: #28a745; font-weight: bold;">✓ Vous êtes inscrit à ce cours</p>
                <form action="/student/unenroll/<?php echo $course['id']; ?>" method="POST" style="display: inline;">
                    <button type="submit" class="btn" style="background: #dc3545;" onclick="return confirm('Êtes-vous sûr de vouloir vous désinscrire?')">Se désinscrire</button>
                </form>
            <?php else: ?>
                <form action="/student/enroll/<?php echo $course['id']; ?>" method="POST" style="display: inline;">
                    <button type="submit" class="btn success">S'inscrire à ce cours</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
