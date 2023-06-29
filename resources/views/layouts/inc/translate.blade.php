<!-- Thêm các mã JavaScript để sử dụng Google Translate API -->
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
                pageLanguage: 'en'
            },
            'google_translate_element'
        );
    }
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<style>
    body {
        top: 0px !important;
        position: static !important;
    }

    .goog-te-banner-frame {
        display: none !important
    }

    .goog-te-combo {
        width: 100%;
        height: 40px;
        border-radius: 5px;
    }

    .goog-te-gadget {
        color: #040f1c00;
    }

    .goog-logo-link,
    .goog-logo-link:link,
    .goog-logo-link:visited,
    .goog-logo-link:hover,
    .goog-logo-link:active {
        font-size: 12px;
        font-weight: bold;
        color: #040f1c00;
        text-decoration: none;
        visibility: hidden;
    }
</style>
