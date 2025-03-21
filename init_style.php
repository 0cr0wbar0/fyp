<?php
function init_style(): string {
    return $_COOKIE['theme'] ?? '/static/stylesheet.css';
}