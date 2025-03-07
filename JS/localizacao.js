<div class="row">
    <div class="col-12">
        <h4 class="text-center">Nossa Localização</h4>
        <button onclick="getLocation()">Ativar Localização</button>
        <div class="map-container">
            <iframe id="map" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation não é suportado pelo seu navegador.");
        }
    }

    function showPosition(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        
        // Atualiza o src do iframe com as coordenadas do usuário
        const mapIframe = document.getElementById("map");
        mapIframe.src = `https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1000000!2d${longitude}!3d${latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1632924058581`;
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("Permissão negada para acessar localização.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Informação de localização não está disponível.");
                break;
            case error.TIMEOUT:
                alert("A requisição expirou.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Ocorreu um erro desconhecido.");
                break;
        }
    }
</script>
