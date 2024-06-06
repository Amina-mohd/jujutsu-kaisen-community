<?php
require 'connect.php';
require_once 'php-google-translate-free-master/src/GoogleTranslate.php';
use Statickidz\GoogleTranslate;

if (isset($_POST['title']) && isset($_POST['content'])) {
    $source = 'auto'; // Detect language automatically
    $target = 'en'; // Translate to English
    $title = $_POST['title'];
    $content = $_POST['content'];

    try {
        $translatedTitle = GoogleTranslate::translate($source, $target, $title);
        $translatedContent = GoogleTranslate::translate($source, $target, $content);
        echo json_encode(['title' => $translatedTitle, 'content' => $translatedContent]);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}