<?php
function setActive($route) {
    return request()->routeIs($route) ? "active" : "";
}