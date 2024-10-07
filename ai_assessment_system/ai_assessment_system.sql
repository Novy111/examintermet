-- ============================================
-- إنشاء قاعدة البيانات ونظام الترميز
-- ============================================

-- إنشاء قاعدة البيانات إذا لم تكن موجودة
CREATE DATABASE IF NOT EXISTS ai_assessment_system
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- استخدام قاعدة البيانات الجديدة
USE ai_assessment_system;

-- ============================================
-- إنشاء جدول المستخدمين (Users)
-- ============================================

CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('مدرس', 'طالب') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- إنشاء جدول الاختبارات (Exams)
-- ============================================

CREATE TABLE IF NOT EXISTS Exams (
    exam_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    teacher_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES Users(user_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- إنشاء جدول الأسئلة (Questions)
-- ============================================

CREATE TABLE IF NOT EXISTS Questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT NOT NULL,
    question_text TEXT NOT NULL,
    correct_answer VARCHAR(255) NOT NULL,
    FOREIGN KEY (exam_id) REFERENCES Exams(exam_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- إنشاء جدول إجابات الطلاب (Student_Answers)
-- ============================================

CREATE TABLE IF NOT EXISTS Student_Answers (
    answer_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    question_id INT NOT NULL,
    student_answer VARCHAR(255) NOT NULL,
    is_correct BOOLEAN,
    score DECIMAL(5,2) DEFAULT 0,
    answered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES Users(user_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (question_id) REFERENCES Questions(question_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- إنشاء جدول نتائج الطلاب (Student_Results)
-- ============================================

CREATE TABLE IF NOT EXISTS Student_Results (
    result_id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT NOT NULL,
    student_id INT NOT NULL,
    total_score DECIMAL(10,2) NOT NULL DEFAULT 0,
    accuracy_percentage DECIMAL(5,2) NOT NULL DEFAULT 0,
    completed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (exam_id) REFERENCES Exams(exam_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (student_id) REFERENCES Users(user_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- (اختياري) إضافة فهارس لتحسين الأداء
-- ============================================

-- إضافة فهرس على جدول Users لتحسين البحث بواسطة البريد الإلكتروني
CREATE INDEX idx_users_email ON Users(email);

-- إضافة فهرس على جدول Exams لتحسين البحث بواسطة teacher_id
CREATE INDEX idx_exams_teacher_id ON Exams(teacher_id);

-- إضافة فهرس على جدول Questions لتحسين البحث بواسطة exam_id
CREATE INDEX idx_questions_exam_id ON Questions(exam_id);

-- إضافة فهرس على جدول Student_Answers لتحسين البحث بواسطة student_id و question_id
CREATE INDEX idx_student_answers_student_question ON Student_Answers(student_id, question_id);

-- إضافة فهرس على جدول Student_Results لتحسين البحث بواسطة exam_id و student_id
CREATE INDEX idx_student_results_exam_student ON Student_Results(exam_id, student_id);
