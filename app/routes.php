<?php

Route::get("/", "HomeController@index");

Route::group(["prefix" => "api/v1"], function() {
    Route::resource("todos", "TodosController");
});
