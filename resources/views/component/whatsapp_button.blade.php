<style>
    /* Menghilangkan branding bawaan edna.io dan menggantinya dengan Andre.devlog */
    .wa-chat-box-poweredby {
        font-size: 0 !important;
        margin-top: 10px !important;
        margin-bottom: 5px !important;
        opacity: 0.8;
    }
    .wa-chat-box-poweredby::before {
        content: "Andre.devlog";
        font-size: 11px !important;
        font-style: normal !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #666;
        display: inline-block;
    }
    .wa-chat-box-poweredby a {
        display: none !important;
    }
</style>

<script>
    (function() {
        var url = 'https://edna.io/wp-content/plugins/whatsapp-widget-generator/js/generator.js?70135';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url;
        var options = {
            "host": "https://edna.io",
            "enabled": true,
            "chatButtonSetting": {
                "backgroundColor": "#4fce5d",
                "ctaText": "",
                "icon": "whatsapp",
                "position": "right",
            },
            "brandSetting": {
                "backgroundColor": "#085b53",
                "brandImg": "{{ setting('site_logo', 'https://edna.io/wp-content/plugins/whatsapp-widget-generator/img/edna-logo.svg') }}",
                "brandName": "{{ setting('site_name', 'Andrew.Devlog') }}",
                "brandSubTitle": "Typically replies within a day",
                "ctaText": "Start Chat",
                "phoneNumber": "{{ setting('contact_whatsapp', '6281343323155') }}",
                "welcomeText": "Halo! Ada yang bisa kami bantu? Klik tombol di bawah untuk mulai chat."
            }
        };
        s.onload = function() {
            CreateWhatsappChatWidget(options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>
