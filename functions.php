<?php
    add_action( 'wp_enqueue_scripts', 'childhood_styles' ); 
    add_action( 'wp_enqueue_scripts', 'childhood_scripts' ); //создаем хук, когда начнет выполняться стандартный wp_enqueue_scripts, тогда же запутится наш childhood_scripts

    function childhood_styles() {
        wp_enqueue_style('childhood-style', get_stylesheet_uri()); // запускаем стили. childhood-style - название файла со стилями, get_stylesheet_directory_uri - подключаем style.css стандартным вордпрессовским методом
    }

    function childhood_scripts() {
        wp_enqueue_script( 'childhood-script', get_template_directory_uri() . '/assets/js/main.min.js', array(), null, true ); // get_template_directory_uri - путь до темы + продолжение пути до файла скрипта, array('jquery') - зависимость, запустится тогда же, когда и jquery, null - версия скрипта, true - будет подключаться в футере(да/нет)

        //переподключаем самый последний jquery
        wp_deregister_script( 'jquery' );
        wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.slim.min.js' );
        wp_enqueue_script('jquery');
    }
    add_theme_support('custom-logo'); //включена возможность добавлять кастомное лого
    add_theme_support('post-thumbnails'); //включена "установить изображение записи" в постах, которую можно нахначить фоном для превью карточки товара на главной

    function my_acf_google_map_api( $api ){ // регистрирую апи для карты
        $api['key'] = 'AIzaSyCsLztfO7Xke22AAKUzuo5BwvKBNvDqsTQ';
        return $api;
    }
    add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
?>