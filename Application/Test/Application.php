<?php
    
    namespace Application\Test;
    
    $App = new \Rqo\Application("127.0.0.1:8000", []);
    
    $Route = new \Rqo\Http\Route();
    
    $Route->get("/", function(\Rqo\Http\Request $req){
        
        $resp = new \Rqo\Http\Response(200);
        
        $header = new \Rqo\Http\Header([
                "content-type" => "text/html"
            ]);
        
        $resp->header($header);
        
        $version = RQO_VERSION;
        
        $ctnt = <<<RES
<html>
<head>
    <meta charset="utf-8" />
    <title>Welcome to RQO!</title>
</head>
<body>
    <h1>This is RQO.</h1>
    <p>RQO is a Quick, Responsive, Objective Framework for developing High-Performance APIs and MVVM Backends.</p>
    <p>RQO is Open-Source, written by xtl<xtl@xtlsoft.top>, GitHub: <a href="/github.do">xtlsoft/RQO</a>.</p>
    <p>RQO is Based on ReactPHP.</p>
    <hr />
    <p>RQO Version: {$version}</p>
</body>
RES;
        
        $resp->write($ctnt);
        
        return $resp;
        
    });
    
    $Route->get("/github.do", function(\Rqo\Http\Request $req){
        
        return (new \Rqo\Http\Response(302))->
            header(new \Rqo\Http\Header([ "location" => "https://github.com/xtlsoft/RQO" ]))->
            write("<a href=\"https://github.com/xtlsoft/RQO\">If you did not redirect, click this message.</a>");
        
    });
    
    $App->route($Route);
    
    \Rqo\Application::add($App);
    
