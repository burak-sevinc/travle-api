<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crackcode Public API</title>
    <script src="https://unpkg.com/@stoplight/elements/web-components.min.js?v=<?= date('Ymdhis') ?>"></script>
    <link rel="stylesheet" href="https://unpkg.com/@stoplight/elements/styles.min.css?v=<?= date('Ymdhis') ?>">
    <style>
        .sl-panel {
            margin-top: 20px;
        }

        .sl-relative[data-testid="two-column-right"] .sl-code-viewer__scroller:has(.language-json) {
            min-height: 800px;
            resize: vertical;
        }

        .sl-relative[data-testid="two-column-right"] .sl-code-viewer__scroller .language-json {
            height: 800px;
            overflow-wrap: break-word;
        }

        @media screen and (min-width: 1920px) {

            .sl-flex-1[data-testid="two-column-left"] {
                flex: 0;
                min-width: 600px;
            }

            .sl-relative[data-testid="two-column-right"] {
                flex: 1;
                min-width: 800px;
            }
        }

        @media screen and (min-width: 2560px) {

            .sl-flex-1[data-testid="two-column-left"] {
                flex: 0;
                min-width: 800px;
            }

            .sl-relative[data-testid="two-column-right"] {
                flex: 1;
                min-width: 1200px;
            }
        }
    </style>
</head>
<body>
<elements-api
    apiDescriptionUrl="/docs/public-api/openapi.yml?v=<?= date('Ymdhis') ?>"
    router="history"
    basePath="/docs/public-api"
    layout="responsive"
/>
<script>
    window.addEventListener("dblclick", function (event) {
        if (event.target.className === 'token string' && event.target.innerText.indexOf('ey') === 1) {
            navigator.clipboard.writeText(event.target.innerText.replace(/"/g, ''));
        }
    });

</script>
</body>
</html>

