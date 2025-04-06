require.config({ paths: { vs: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.30.1/min/vs' }});

require(['vs/editor/editor.main'], function() {
    const editor = monaco.editor.create(document.getElementById('editor'), {
        value: '// Начните писать код здесь\n',
        language: 'php',
        theme: 'vs-dark',
        automaticLayout: true,
        minimap: {
            enabled: false
        },
        fontSize: 16,
        lineNumbers: 'on',
        scrollBeyondLastLine: false,
        roundedSelection: true,
        renderLineHighlight: 'all'
    });

    // Обработка изменения языка
    document.getElementById('language').addEventListener('change', function(e) {
        monaco.editor.setModelLanguage(editor.getModel(), e.target.value);
    });

    // Обработка запуска кода
    document.getElementById('runCode').addEventListener('click', async function() {
        const code = editor.getValue();
        const language = document.getElementById('language').value;
        const output = document.getElementById('output');

        output.innerHTML = '<div class="loading">Выполняется...</div>';

        try {
            const response = await fetch('/api/sandbox/run', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ code, language })
            });

            const result = await response.json();
            
            if (result.error) {
                output.innerHTML = `<pre class="error">${result.error}</pre>`;
            } else {
                output.innerHTML = `<pre>${result.output}</pre>`;
            }
        } catch (error) {
            output.innerHTML = '<pre class="error">Ошибка выполнения</pre>';
        }
    });
});
