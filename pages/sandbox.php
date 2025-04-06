<?php
require_once __DIR__ . '/../includes/functions.php';
$auth = Auth::getInstance();
$auth->requireAuth();

$title = "Песочница";
require_once __DIR__ . '/../includes/header.php';
?>

<section class="sandbox-page">
    <div class="container">
        <div class="sandbox-header">
            <h1 class="section-title">Песочница</h1>
            <div class="sandbox-controls">
                <select class="sandbox-language" id="language">
                    <option value="php">PHP</option>
                    <option value="javascript">JavaScript</option>
                    <option value="python">Python</option>
                </select>
                <button class="btn btn--primary" id="runCode">
                    <span class="material-icons">play_arrow</span>
                    Запустить
                </button>
            </div>
        </div>

        <div class="sandbox-editor">
            <div class="editor-container">
                <div id="editor"></div>
            </div>
            <div class="output-container">
                <h3>Результат</h3>
                <div id="output"></div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.30.1/min/vs/editor/editor.main.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.30.1/min/vs/loader.js"></script>
<script src="/assets/js/sandbox.js"></script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
