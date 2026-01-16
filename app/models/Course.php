<?php
namespace App\Models;

class Course {
    private $db;
    
    public function __construct() {
        $this->db = \App\Core\Database::getPDO();
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM courses");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function getStudentCourses($studentId) {
        $stmt = $this->db->prepare("
            SELECT c.* FROM courses c
            JOIN enrollments e ON c.id = e.course_id
            WHERE e.student_id = ?
        ");
        $stmt->execute([$studentId]);
        return $stmt->fetchAll();
    }
}
