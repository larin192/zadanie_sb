<?php
class User {
    public $user_data;

    public function __construct($id = NULL)
    {
        //w konstruktorze klasy przy podanym id wyciągamy tylko konkretnego użytkownika, jeżeli nie podamy id wyciągamy wszystkich
        if(isset($id)){
            $url = "https://jsonplaceholder.typicode.com/users/".$id;
        } else {
            $url = "https://jsonplaceholder.typicode.com/users/";
        }
        $content = json_decode(file_get_contents($url), true);

        $this->user_data = $content;
    }
    public function getDomain($mail){

        //sprawdź czy podana zmienna na pewno jest adresem email
        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            //jesli tak - rozdziel ciag tekstu w miejscu @ - zwraca tablice stringów
            $tmp = explode('@', $mail);
            //wybierz ostatnią pozycje z tablicy - czyli domene
            $domain_name = end($tmp);
            return $domain_name;
        } else {
            return "zły format adresu";
        }
    }
    public function generateQR(){
        //stwórz jsona z informacji uzytkownika
        $data = json_encode($this->user_data, JSON_UNESCAPED_UNICODE);
        //a tu link do api google charts
        $qr_url = 'https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl='.urlencode($data).'';
        //wygeneruj obrazek z kodem qr
        echo '<img src="'.$qr_url.'"/>';
    }

    public function getPersonData(){
        $data = json_encode($this->user_data);
        return $data;
    }
}